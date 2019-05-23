<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use Carbon\Carbon;
use Auth;
use DB;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Product;
use App\ShopCart;
use App\Courier;
use App\Transaction;
use App\Cart;


class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;


        $cart = new ShopCart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        if(Auth::id()){
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->product_id = $id;
            $cart->qty = 1;
            $cart->status = "notyet";
            $cart->save();
        }

        return redirect()->back();

    }

    public function checkout()
    {

        $client = new Client();

        try {
            $kabupaten = $client->get('https://api.rajaongkir.com/starter/city',
                        array(
                            'headers' => array(
                                'key' => '739afec044a0280908b3dbdb52eb4675',
                            )
                        )
                    );


        } catch (RequestExecption $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }


        $kurir = Courier::where('status',1)->get();

        $json_kab = $kabupaten->getBody()->getContents();

        $kab = json_decode($json_kab,true);
      
        return view('user.cart.checkout')->with([
            'kabupaten_list' => $kab["rajaongkir"]["results"],
            'kurir_list' => $kurir,
        ]);

    }

    /**
     * Get Ongkos Kirim
     */
    public function checkOngkir(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'address' => 'required|string|max:255',
            'kabupaten' => 'required',
            'courier' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withError($validator);
        }
        
        $client = new Client();

        try {

            $kabupaten = $client->get('https://api.rajaongkir.com/starter/city',

                    array(
                        'headers' => array(
                            'key' => '739afec044a0280908b3dbdb52eb4675',
                        )

                )
            );

        } catch (RequestExecption $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json_kab = $kabupaten->getBody()->getContents();

        $list_kab = json_decode($json_kab,true);

        foreach($list_kab['rajaongkir']['results'] as $kab){

            if($kab['postal_code'] == $request->kabupaten){

                $id_destinasi = $kab['city_id'];
                break;

            }

        }

        $url = 'origin=114&destination=' . $id_destinasi . '&weight=1700&courier=' . $request->courier;

        $client = new Client();

        try{
            
            $shipping_cost = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                
                    ['body' => $url,
                    'headers' => [
                        'content-type' => 'application/x-www-form-urlencoded',
                        'key' => '739afec044a0280908b3dbdb52eb4675',
                        ]
                    ]
            );
                   

        } catch (RequestExecption $e) {
            var_dump($e->getResponse()->getBody()->getContents());
        }

        $json_cost = $shipping_cost->getBody()->getContents();

        $ongkir = json_decode($json_cost,true);

        // $ongkir = $ongkir['rajaongkir']['result'][0]['costs'];
            

        

        return view('user.cart.checkout-verifikasi')->with([
                    
                    'ongkir' => $ongkir['rajaongkir']['results'],
                    'request' => $request,
                    'kabupaten' => $kab,
                    ]);
        
    }     


    /**
     * Buy Proccess
     */
    public function prosesBeli(Request $request)
    {

        $id_kurir = Courier::select('id')->where('kode',$request->courier)->first();

        $cart = Session::get('cart');

        DB::transaction(function() use($request, $id_kurir){

            $transaction = new Transaction;
            $transaction->timeout = Carbon::tomorrow();
            $transaction->address = $request->address;
            $transaction->regency = $request->kabupaten;
            $transaction->province = $request->provinsi;
            $transaction->total = $request->grand_total;
            $transaction->shipping_cost = $request->ship_cost;
            $transaction->sub_total = $request->sub_total;
            $transaction->user_id = Auth::id();
            $transaction->courier_id = $id_kurir->id;
            $transaction->proof_of_payment = "No Data";
            $transaction->status = "unverified";
            $transaction->save();

            $carts = Session::get('cart');
            // dd($cart->items['item']->id);
    
            $items = [];
            foreach($carts->items as $cart){
                array_push($items,$cart);
            }
            
            foreach($items as $item){
                DB::table('transaction_details')->insert([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['item']->id,
                    'qty' => $item['qty'],
                    'discount' => 0,
                    'selling_price' => $item['item']->price,
                    'status_barang' => 'Packing',
                ]);
            }


        });

        return redirect()->route('destroy.cart');
    }

    /**
     * Destroy after buy
     */
    public function destroy()
    {
        session()->forget('cart');
        return redirect()->route('home');
    }

}
