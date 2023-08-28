<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function dashboard()
    {
        $allUsers = User::all();
        // $activeUserPlans = Plan::where('status', 1)->get();
        // dd($activeUserPlans);
        return view('admin.dashboard', compact('allUsers'));
    }




}
