<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Image;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Notifications\AdminNotif;

use DB;
use App\Product;
use App\Discount;
use App\Transaction;
use App\User;
use App\Admin;

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

            $data_images[] = DB::table('products')->select('products.id as id_product','products.*','product_images.*')
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
     * Melihat seluruh Review
     */
    public function productDetail($id)
    {   
 
        $products = Product::find($id);
        
        $review = DB::table('product_reviews')->select('users.id as id_user','users.*','product_reviews.*')
                    ->join('users','product_reviews.user_id','=','users.id')
                    ->where('product_id',$id)->get();

    $id_review = [];
        foreach ($review as $r) {
            
            array_push($id_review,$r->id);
            
        }

        $response = DB::table('response')->whereIn('review_id',$id_review)->get();

        return view('user.review.review_product')->with(['reviews' => $review, 'products' => $products, 'response' => $response]);
    }

    /**
     * Show Order List and Track Order
     */
    public function showOrder()
    {

        $transaksi = Transaction::where('user_id',Auth::id())->get();
        $id = Auth::id();
        $list = [];
        foreach($transaksi as $trans){
            
            $data = DB::table('transaction_details')
                ->join('products','transaction_details.product_id','=','products.id')
                ->join('transactions','transaction_details.transaction_id','=','transactions.id')
                ->where('transactions.user_id',$id)
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

        $user = Admin::find(1);
        
        $action = Route('show.detail.transaksi',$proof->id);
        $message = "<a href=$action>Ada upload bukti transaksi baru!</a>";
        $user->notify(new AdminNotif($message));

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
        
        $produk = Product::find($request->product_id);
        $admin = Admin::find(1);
        $message = "Ada Review untuk " . $produk->product_name . '!';
        
        $admin->notify(new AdminNotif($message));

        return redirect()->route('show.order');
    }


    /**
     * Mark as read notif
     */
    public function markRead(){
        $user = User::find(Auth::id());
        $user->unreadNotifications()->update(['read_at' => now()]);
        return response()->json($user);
    }


}