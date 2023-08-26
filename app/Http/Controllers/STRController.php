<?php

namespace App\Http\Controllers;

use App\Models\STR;
use Illuminate\Http\Request;

class STRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return STR::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function show(STR $sTR)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function edit(STR $sTR)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, STR $sTR)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\STR  $sTR
     * @return \Illuminate\Http\Response
     */
    public function destroy(STR $sTR)
    {
        //
    }
}
