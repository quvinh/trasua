<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function orderProduct()
    {
        $product = DB::table('products')
        ->join('sizes','sizes.id_size','products.id_size')
        ->select(
            'products.id_product as id_product',
            'products.name as name',
            'products.price as price',
            'products.image as image',
            'products.unit as unit',
            'sizes.name as size',
        )
        ->where('products.visible', '1')->get();
        return response()->json([
            'product' => $product,
        ]);
    }

    public function searchProduct(Request $request)
    {
        if ($request->id_category == null) {
            $product = DB::table('products')
                ->where([
                    ['visible', '1'],
                    ['name', 'like', $request->name . '%']
                ])->get();
        } else {
            $product = DB::table('products')
                ->where([
                    ['visible', '1'],
                    ['name', 'like', $request->name . '%'],
                    ['id_category', $request->id_category],
                ])->get();
        }

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
