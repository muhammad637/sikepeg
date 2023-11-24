<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index(){

        // return 'testing';
        $admin = auth()->guard('admin')->user();
        return view('pages.profile.index', [
            'admin' => $admin
        ]);
    }

    public function edit(Admin $admin)
    {
        //
        // return $user->ruangan;
        return view(view('pages.profile.index', [
            'admin' => $admin,
        ]));
    }
    
    public function update(Request $request, Admin $admin){
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required',
           
        ]);

        $update = $admin->update($validateData);
        $update;
        alert()->success('Update Data Profile Berhasil');
        return redirect()->back();
    }

    public function password(Request $req, Admin $admin){
        $validateData = $req->validate([
            'password' => 'required',
            'newPassword' => 'required|min:8'
        ]);
        $password = Hash::check($validateData['password'],
        $admin->password);
        if ($password) {
            $admin->update(['password' => Hash::make($validateData['newPassword'])]);
            Auth::logout();
            $req->session()->invalidate();
            $req->session()->regenerateToken();
            alert()->success('Perubahan Password Berhasil');
            return redirect('/admin/login');
        } else {
            alert()->error('Perubahan Password Gagal');
            return redirect()->back();
        }
    }

    

    //
}
