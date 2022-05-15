<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SystemController extends Controller
{
    public function role()
    {
        $list = Role::all();
        return view('admin.components.system.role', compact('list'));
    }

    public function getRole($id)
    {
        $group = array(
            'pro' => 'Sản phẩm',
            'for' => 'Công thức',
            'bil' => 'Hoá đơn',
            'tab' => 'Bàn đặt',
            'sto' => 'Kho nguyên liệu',
            'sho' => 'Cửa hàng',
            'cus' => 'Khách hàng',
            'acc' => 'Hệ thống'
        );
        $system = Permission::where([['name', 'like', 'sys%']]);

        $role = Role::findById($id);
        $permission = $role->getAllPermissions();
        return view('admin.components.system.roleDetail', compact('role', 'permission', 'group'));
    }

    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);
        $role->givePermissionTo(Permission::where([
            ['name', 'not like', 'sto%'],
            ['name', 'not like', 'sho%'],
            ['name', 'not like', 'acc%'],
            ['name', 'not like', 'cus%'],
            ['name', 'not like', '%confirm'],
            ['name', 'not like', '%delete'],
            ['name', 'not like', '%edit'],
            ['name', 'not like', '%add'],
        ])->get());

        return redirect()->back()->with('success', 'Lưu thành công');
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'permission' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $permission = explode(',', $request->permission);

        Role::findById($id)->syncPermissions();
        Role::findById($id)->givePermissionTo($permission);

        // return redirect()->route('admin.get-role', $id)->with('success', 'Lưu quyền thành công');
        return response()->json([
            'messsage' => 'Lưu thành công',
        ], 201);
    }

    public function deleteRole($id)
    {
        Role::findById($id)->syncPermissions();
        Role::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Xoá thành công');
    }

    public function log()
    {
        return view('admin.components.system.log');
    }
}
