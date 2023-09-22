<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiklatController extends Controller
{
    //
    public function index(){
        return view('pages.diklat.index');
    }

    public function create(){
        return view('pages.diklat.create');
    }
    public function show(){
        return view('pages.diklat.edit');
    }
}
