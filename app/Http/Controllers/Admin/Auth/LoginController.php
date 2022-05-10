<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $pattern = [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:6|max:100',
        ];

        $messenger = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
        ];

        $customName = [
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];

        $validator = Validator::make($request->all(), $pattern, $messenger, $customName);

        if ($request->getMethod() == 'GET') {
            return view('admin.auth.login');
        }

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credentials = $request->only(['username', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            // return redirect()->back()->withInput();
            return redirect()->back()->withErrors(['msg' => 'Tên đăng nhập/Mật khẩu không đúng']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
