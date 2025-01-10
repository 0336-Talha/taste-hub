<?php

namespace App\Http\Controllers;
use Validator;
use Auth;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function authenticate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'email'=>'email|required',
            'password'=>'required|max:8',
        ]);
        
         if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))){
            return redirect()->route('admin.dashboard');
         }else{
            session()->flash('error','Either Email or Password is incorrect');
            return back()->withInput($request->only('email'));
         }

    }
}
