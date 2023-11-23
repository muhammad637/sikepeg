<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(){


        $admin = auth()->guard('admin')->user();
        return view('pages.profile.index', [
            'admin' => $admin
        ]);
    }
    //
}
