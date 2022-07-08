<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    public function orderProduct()
    {
        $product = DB::table('products')
            ->join('sizes', 'sizes.id_size', 'products.id_size')
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

    public function saveBillCounter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_product' => 'required',
            'amount_product' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $list_product = explode('|`|', $request->id_product);
        $amount_product = explode('|`|', $request->amount_product);

        Bill::create(array_merge(
            $validator->validated(),
            [
                'payment' => $request->payment,
                'discount' => 0,
                'created_by' => Auth::guard('admin')->user()->id,
                'description' => '',
                'status' => 1
            ]
        ));

        $id_bill = DB::table('bills')->max('id_bill');
        $date = date('m-Y');
        foreach ($list_product as $index => $id_product) {
            if ($id_product != '' && is_numeric($id_product)) {
                BillInfo::create(array_merge(
                    [
                        'id_bill' => $id_bill,
                        'id_product' => $id_product,
                        'month' => $date,
                        'amount' => $amount_product[$index]
                    ]
                ));
            }
        }
        return redirect()->back()->with('success', 'Đã thanh toán đơn');
    }
}
