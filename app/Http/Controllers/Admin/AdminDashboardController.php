<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
