<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

use App\Notifications\UserNotif;

use App\Transaction;
use App\User;


class AllController extends Controller
{
    /**
     * Transaksi COntroler
     */
    public function showTransaction()
    {
        $data = DB::table('transactions')->select('transactions.id as id_transaction','transactions.*', 'users.*','couriers.*')
                ->join('users','transactions.user_id','=','users.id')
                ->join('couriers','transactions.courier_id','=','couriers.id')
                ->orderBy('transactions.created_at','desc')->get();
        

        return view('admin.transaction.adminShowTransaction')->with('data',$data);
    }

    public function DetailTransaction($id)
    {
        $data = Transaction::find($id);
    
        return view('admin.transaction.adminDetailTransaction')->with('data',$data);
    }

    public function updateDetailTransaction(Request $request)
    {
        
        $transaksi = Transaction::find($request->id_transaksi);
        $transaksi->status_transaksi = $request->status;
        $transaksi->save();
        
        if($request->status == "delivered"){
            
            DB::table('transaction_details')->where('transaction_id',$transaksi->id)
            ->update(['status_barang' => 2]);

        } elseif($request->status == "success") {

            DB::table('transaction_details')->where('transaction_id',$transaksi->id)
            ->update(['status_barang' => 3]);
            
        }

        $data_trans = DB::table('transaction_details')->where('transaction_id',$transaksi->id)
                ->first();

        $user = User::find($request->id_user);
        
        $action = route('detail.order',$data_trans->id_transaction_details);
        $message = "<a href=$action>Status barangmu kini : $transaksi->status_transaksi</a>";

        $user->notify(new UserNotif($message));

        return redirect()->route('index.transaksi');

    }


    /**
     * Review List
     */
    public function showReview()
    {
        $review = DB::table('product_reviews')->select('users.id as id_user','product_reviews.id as reviews_id' ,'users.*','product_reviews.*','products.*')
                    ->join('users','product_reviews.user_id','=','users.id')
                    ->join('products','product_reviews.product_id','=','products.id')
                    ->get();

        return view('admin.response.review_list')->with('reviews',$review);
    }


    /**
     * Balas Review
     */
    public function balasReview($id)
    {
        $id_review = DB::table('product_reviews')->where('id',$id)->first();

        return view('admin.response.review_balas')->with('review',$id_review);


    }

    /**
     * Post Response
     */
    public function postResponse(Request $request)
    {

        $review = DB::table('product_reviews')->where('id',$request->id_reviews)->first();

        DB::table('response')->insert([
            'review_id' => $request->id_reviews,
            'admin_id' => Auth::guard('admin')->user()->id,
            'content' => $request->content,
        ]);
        
        
        $user = User::find($request->id_user);
        
        $action = Route('detail.product',$review->product_id);
        $message = "<a href=$action>Admin membalas review anda</a>";
        $user->notify(new UserNotif($message, $action));

        return redirect()->route('show.reviews');
    }



}
