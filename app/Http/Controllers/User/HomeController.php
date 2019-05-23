<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Image;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use DB;
use App\Product;
use App\Discount;
use App\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home.home');
    }

    /**
     * Show User Profile
     */
    public function profile()
    {
        return view('user.profile.profile');
    }


    /**
     * Show Products
     */
    public function product()
    {

        $data = Product::where('status',1)->get();


        foreach($data as $d){

            $data_images[] = DB::table('products')
                    ->join('product_images','products.id','=','product_images.product_id')
                    ->where('product_images.product_id',$d->id)->first();

            $discount = Discount::where([
                ['start','<=',date('Y-m-d',time())],
                ['end','>=',date('Y-m-d',time())],
            ])->get();
            
            
            if(isset($discount)){

                    foreach($discount as $disc){

                        if($d->id == $disc->product_id){
                            $potongan = $d->price * $disc->percentage / 100;
                            $disc_price = $d->price - $potongan;
                            $discount_price[] = ['product_id' => $d->id, 'discount_price' => $disc_price];
                        }

                    }
            
            

            }
            
            // $images[] = ['product_id' => $d->product_id, 'image' => $data_images->image_location];
        }

        if($discount->isEmpty()){
               
            return view('user.product.product')->with(['data' => $data_images, 'discount' => NULL, 'disc_prices' => NULL]);

       }

        if(isset($discount)){
            return view('user.product.product')->with(['data' => $data_images, 'discount' => $discount, 'disc_prices' => $discount_price]);
        }
        
        
    }

    /**
     * Show Order List and Track Order
     */
    public function showOrder()
    {

        $transaksi = Transaction::where('user_id',Auth::id())->get();

        $list = [];
        foreach($transaksi as $trans){
            
            $data = DB::table('transaction_details')
                ->join('products','transaction_details.product_id','=','products.id')
                ->join('transactions','transaction_details.transaction_id','=','transactions.id')
                ->get();

            array_push($list,$data);

        }

        
        
        return view('user.transaction.transaction_list')->with([
            'list_transaksi' => $transaksi,
            'barang' => $list,
            ]);

    }

    /**
     * Cancel Order
     */
    public function cancelOrder($id)
    {
        DB::table('transaction_details')->where('id_transaction_details',$id)->update(['status_barang' => 'Canceled']);
        return redirect()->back();
    }

    /**
     * Transaksi Detail Barang
     */
    public function transactionDetail($id)
    {
        
        $data = DB::table('transaction_details')
                    ->join('transactions','transaction_details.transaction_id','=','transactions.id')
                    ->join('products','transaction_details.product_id','=','products.id')
                    ->where('transaction_details.id_transaction_details',$id)->get();

        foreach($data as $d){
            $da = $d;
        }

        return view('user.transaction.transaction_detail')->with('data',$da);
    }

    /**
     * Upload bukti pembayaran
     */
    public function UploadBukit(Request $request)
    {
        // dd($request->id_transaksi);
        if($request->hasFile('proof_of_payment')){

            $image = $request->file('proof_of_payment');
            $name = time();
            $ext = $image->getClientOriginalExtension();
            $name = $name . '.' . $ext;
            $image_path = public_path('/proof/'.$name);
            Image::make($image)->save($image_path);

            $proof = Transaction::find($request->id_transaksi);
            $proof->status_transaksi = 'verified';
            $proof->proof_of_payment = $name;
            $proof->save();
        }

        return redirect()->back();
    }



    /**
     * View Review
     */
    public function reviewForm($id)
    {  
        $data = Product::find($id);

        return view('user.review.review')->with('data',$data);
    }

    /**
     * Post Review
     */
    public function postReview(Request $request)
    {
        DB::table('product_reviews')->insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'rate' => $request->rate,
            'content' => $request->review,
        ]);

        return redirect()->route('show.order');
    }


}
