<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request){
        $request->validate(['name' => 'required','username'=>'required|unique:users,username','email'=>'required|unique:users,email']);
        User::create($request->all());
    }
}
