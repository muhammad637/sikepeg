<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller    
{
    //
    public function loginHandler(Request $request){
        $request->validate([
            'username' => 'required|exists:admins,username',
            'password' => 'required',
        ],[
            'username.required' => 'kolom username masih kosong',
            'username.exists' => 'username yang anda masukkan tidak ada',
            'password.required' => 'kolom password masih kosong'
        ]);

        $cred = array(
            'username' => $request->username,
            'password' => $request->password,
        );
        if(Auth::guard('admin')->attempt($cred)){
            return redirect()->route('admin.home');
        }else{
            session()->flash('fail','akun yang anda masukkan tidak di temukan');
            return redirect()->back();
        }
    }

    public function logoutHandler(){
        Auth::guard('admin')->logout();
        session()->flash('fail','anda sudah logout di sistem');
        return redirect()->route('admin.login');
    }
}
