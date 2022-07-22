<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.auth.login');
        }

        $credentials = $request->only(['username', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function register(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.components.register');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        DB::table('users')->insert([
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => str_replace(' ', '', $request->phone),
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
