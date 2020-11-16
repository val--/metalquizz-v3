<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
		$request->validate([
		    'name' => ['required'],
		    'email' => ['required', 'email', 'unique:users'],
		    'password' => ['required'],
		]);

		var_dump($request); die();

		// Creating the user
		User::create([
		    'name' => $request->name,
		    'email' => $request->email,
		    'password' => Hash::make($request->password)
		]);
    }
}
