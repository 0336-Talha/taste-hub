<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
