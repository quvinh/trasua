<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function user()
    {
        $list = DB::table('admins')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'admins.id')
            ->select('admins.*', 'model_has_roles.role_id as role')
            ->get();
        return view('admin.components.system.user', compact('list'));
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'name' => 'required|string|between:2,100',
            'phone' => 'required|max:10',
            // 'birthday' => 'required',
            // 'address' => 'required',
            // 'gender' => 'required',
            // 'image' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $gender = 0;
        $image = '';
        if($request->gender == 'on') {
            $gender = 1;
        }

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension, 'jpg') === 0 || strcasecmp($extension, 'png') === 0 || strcasecmp($extension, 'jepg') === 0) {
                $name = Str::random(5) . '_' . $name_file;
                while(file_exists('images/user/'.$name)) {
                    $name = Str::random(5) . '_' . $name_file;
                }
                $file->move('images/user/', $name);
                $image = $name;
            }
        }
        Admin::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                'gender' => $gender,
                'image' => $image,
                'address' => $request->address,
            ]
        ));

        return redirect()->back()->with('success', 'Lưu thành công');
    }

    public function getUser($id)
    {
        $user = DB::table('admins')->where('id', $id)->first();
        $role = Admin::find($id)->roles()->first();
        return view('admin.components.system.userDetail', compact('user', 'role'));
    }

    public function roleUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role_user' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = Admin::find($id);
        $user->assignRole($request->role_user);

        return redirect()->back()->with('success', 'Lưu thành công');
    }

    public function deleteUser($id)
    {
        Admin::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Xoá thành công');
    }
}
