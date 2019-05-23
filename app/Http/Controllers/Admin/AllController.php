<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Transaction;


class AllController extends Controller
{
    /**
     * Transaksi COntroler
     */
    public function showTransaction()
    {
        $data = DB::table('transactions')
                ->join('users','transactions.user_id','=','users.id')
                ->join('couriers','transactions.courier_id','=','couriers.id')
                ->get();



        return view('admin.transaction.adminShowTransaction')->with('data',$data);
    }
}
