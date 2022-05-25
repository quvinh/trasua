<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function orderProduct()
    {
        $product = DB::table('products')->where('visible', '1')->get();
        return response()->json([
            'product' => $product,
        ]);
    }

    public function online()
    {
        return view('admin.components.bill.online');
    }

    public function atTable()
    {
        return view('admin.components.bill.atTable');
    }

    public function atCounter()
    {

        return view('admin.components.bill.atCounter');
    }
}
