<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MutasiController extends Controller
{
    //


    public function index(){
        return view('pages.mutasi.index');
    }
    public function create(){
        return view('pages.mutasi.create');
    }
}
