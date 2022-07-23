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
        
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        // dd($request->all(), $user, Hash::check($request->password_old, $user->password));
        if(Hash::check($request->password_old, $user->password)) {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->back()->with(['success' => 'Mật khẩu đã thay đổi']);
        } else {
            return redirect()->back()->with(['error' => 'Mật khẩu không đúng']);
        }
    } 

    public function changeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        DB::table('users')->where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address
        ]);
        return redirect()->back()->with(['success' => 'Thông tin đã được cập nhật']);
    }
}
