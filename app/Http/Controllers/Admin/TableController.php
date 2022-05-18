<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    public function table()
    {
        return view('admin.components.table.table');
    }

    public function getTable()
    {
        $table = Table::all();
        return response()->json([
            'table' => $table,
        ]);
    }

    public function storeTable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
        ]);

        if($validator->fails()) {
            // return redirect()->back()->withErrors($validator);
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        Table::create(array_merge(
            $validator->validated(),
            [
                'status' => -1,
            ]
        ));

        // return redirect()->back()->with('success', 'Thêm bàn thành công');
        return response()->json([
            'status' => 200,
            'message' => 'Thêm bàn thành công',
        ]);
    }

    public function editTable($id)
    {
        $table = DB::table('tables')->where('id_table', $id)->first();
        return view('admin.components.table.edit', compact('table'));
    }

    public function updateTable(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Table::where('id_table', $id)->update(array_merge(
            $validator->validated(),
            [
                'status' => $request->status,
            ]
        ));

        return redirect()->back()->with('success', 'Thêm bàn thành công');
    }

    public function deleteTable($id)
    {
        DB::table('tables')->where('id_table', $id)->delete();
        // return redirect()->back()->with('success', 'Xoá bàn thành công');
        return response()->json([
            'status' => 'success',
            'message' => 'Xoá bàn thành công',
        ]);
    }
}
