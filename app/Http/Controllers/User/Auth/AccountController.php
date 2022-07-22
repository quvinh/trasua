<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password' => 'confirmed|different:password_old',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        // $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $user = find(Auth::user()->id);
        if(Hash::check($request->password_old, $user->password)) {
            $user->fill([
                'password' => bcrypt($request->password)
            ])->save();

            $request->sesstion()->flash('success', 'Mật khẩu đã thay đổi');
            return redirect()->route('customer-account');
        } else {
            $request->sesstion()->flash('error', 'Mật khẩu không đúng');
            return redirect()->route('customer-account');
        }
    } 
}
