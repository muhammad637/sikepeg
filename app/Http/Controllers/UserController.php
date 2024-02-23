<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    //

    public function store(Request $request){
        $rule = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];

        $validatedData = $request->validate($rule);
        return User::create($validatedData);
    }
}
