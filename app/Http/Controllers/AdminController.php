<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class AdminController extends Controller
{
    //
    public function loginHandler(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:admins,username',
            'password' => 'required',
        ], [
            'username.required' => 'kolom username masih kosong',
            'username.exists' => 'username yang anda masukkan tidak ada',
            'password.required' => 'kolom password masih kosong'
        ]);

        $cred = array(
            'username' => $request->username,
            'password' => $request->password,
        );
        if (Auth::guard('admin')->attempt($cred)) {
            return redirect()->intended(route('admin.home.index'));
        } else {
            session()->flash('fail', 'akun yang anda masukkan tidak di temukan');
            return redirect()->back();
        }
    }

    public function logoutHandler()
    {
        Auth::guard('admin')->logout();
        session()->flash('fail', 'anda sudah logout di sistem');
        return redirect()->route('admin.login');
    }
    public function index()
    {
        $admin = Admin::orderBy('created_at', 'desc')->get();
        return view('pages.master_data.adminManagement.index', [
            'admin' => $admin,
        ]);
    }
    public function create()
    {
        return 'testing';
    }
    public function edit(Admin $admin)
    {
    }

    public function store(Request $request)
    {
        try {
            //code...
            $validatedData = $request->validate(
                [
                    'name' => 'required',
                    'username' => 'required|unique:admins,username',
                    'password' => 'required|min:8'
                ],
                ['username.unique' => 'username sudah ada mohon input kan kembali']
            );
            $validatedData['password'] = Hash::make($validatedData['password']);
            Admin::create($validatedData);
            alert()->success('berhasil tambah Data Admin');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            alert()->error($th->getMessage());
            return redirect()->back();
            
        }
    }
    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'username' => 'required|unique:admins,username,' . $admin->id,
            ]
        );
        $admin->update($validatedData);
        alert()->success('berhasil update Data Admin');
        return redirect()->back();
    }
    public function reset(Request $request, Admin $admin)
    {
        $request->validate([
            'password' => 'required|min:8'
        ]);
        $admin->update([
            'password' => Hash::make($request->password)
        ]);
    }
    public function destroy()
    {
    }
}
