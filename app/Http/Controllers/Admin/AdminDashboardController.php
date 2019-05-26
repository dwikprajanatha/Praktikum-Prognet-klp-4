<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Auth;
use App\Admin;
use App\Transaction;
use DB;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        
        return view('admin.dashboard.dashboard');
    }

    public function yearly_chart(Request $request)
    {

        $tahun = CARBON::NOW()->format('Y');
        $result = \DB::table('transactions')
                    ->select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
                    ->where('status_transaksi','success')
                    ->get();
        return response()->json($result);
        
    }

    public function markReadAdmin()
    {
        $user = Admin::find(Auth::guard('admin')->user()->id);
        $user->unreadNotifications()->update(['read_at' => now()]);
        return response()->json($user);
    }


    public function monthly_chart(Request $request)
    {
        $bulan = Carbon::now()->format('M');
        $first_day = new Carbon('first day of this month');

        $date = $first_day->copy();

        $weeks = [];

        array_push($weeks,$first_day);

        for($i = 0 ; $i < 5 ; $i++){

            $tanggal = $date->copy()->add(7, 'Days');
            
            array_push($weeks,$tanggal);

            $date = $tanggal->copy();
            
        }

        // dd($weeks[0]);

        $results = [];
        $a = 1;

        for($i = 0 ; $i < 5 ; $i++){
            
            

            $result = DB::table('transactions')
            ->select(DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->where('status_transaksi', 'success')
            ->whereBetween('created_at',[$weeks[$i]->toDateTimeString(),$weeks[$a]->toDateTimeString()])->get();
            
            // $result = DB::select(DB::raw("SELECT COALESCE(SUM(total),0) as pendapatan FROM transactions WHERE created_at BETWEEN '$weeks[$i]' AND '$weeks[$a]'"));

            // dd($results);
            // array_push($results,['Pe']);
            // array_push($results,['pendapatan' => $result[0]->pendapatan,'tanggal' => $weeks[$i]->toDateTimeString()]);
            array_push($results, ['weeks' => 'Weeks '.$a , "pendapatan" => $result[0]->pendapatan]);

            $a++;

        }

        // dd($results);

        return response()->json($results);

    }

    public function daily_chart()
    {

        $today = Carbon::now();

        $first_day =  $today->copy()->sub(7, 'day');


        $day = $today->copy()->addDays(1);

        $results = [];

        

        for($i = 0 ; $i < 8 ; $i++){

            $hari = $day->copy()->sub(1, 'day');

            $ha = $hari->copy()->toDateString();

            // dd($ha);

            $result = DB::table('transactions')
            ->select(DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->where(DB::raw('DATE(created_at)'),$ha)
            ->where('status_transaksi', 'success')
            ->get();

            array_push($results,['hari' => $ha, 'pendapatan' => $result[0]->pendapatan]);

            $day = $hari;

        }

        return response()->json($results);

                    

        
    }




}
