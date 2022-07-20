<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.components.order');
        }

        $validator = Validator::make($request->all(), [
            // 'created_by' => 'required',
            'id_product' => 'required',
            'call' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $getID = DB::table('orders')->max('id_order');
        $userID = Auth::user()->id;
        $checkOrder = DB::table('orders')
            ->join('online_orders', 'orders.id_order', '=', 'online_orders.id_order')
            ->select('orders.id_order as id_order', 'orders.amount as amount')
            ->where([['online_orders.id_product', '=', $request->id_product], ['orders.status', '=', 0]]);

        // return response()->json([
        //     'data' => $checkOrder->get()[0],
        //     'status' => 'success',
        //     'message' => 'abc'
        // ]);
        if ($checkOrder->count() > 0) {
            $order = $checkOrder->get()[0];
            DB::table('orders')->where('id_order', $order->id_order)->update(
                [
                    'amount' => intval($order->amount + 1)
                ]
            );
        } else {
            DB::table('online_orders')->insert([
                [
                    'id_product' => $request->id_product,
                    'id_order' => intval($getID + 1),
                    'id_customer' => $userID
                ]
            ]);

            DB::table('orders')->insert([
                [
                    'id_order' => intval($getID + 1),
                    'created_by' => $userID,
                    'amount' => 1,
                    'description' => '',
                    'status' => 0,
                ]
            ]);
        }

        if ($request->call == 'api') {
            $count = DB::table('orders')->select(DB::raw('SUM(amount) as amount'))->where([['created_by', '=', $userID], ['status', '=', 0]])->first()->amount;
            return response()->json([
                'status' => 'success',
                'message' => 'Đã thêm giỏ hàng',
                'count' => $count
            ]);
        } else {
            return view('user.components.order');
        }
    }
}
