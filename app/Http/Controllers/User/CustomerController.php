<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function ordersHistory()
    {
        return view('user.components.customer_orders');
    }

    public function orderHistory($id)
    {
        $id_bill = $id;
        if (DB::table('order_bills')->where('id_bill', $id_bill)->count() > 0) {
            return view('user.components.customer_order', compact('id_bill'));
        } else {
            return view('user.components.customer_orders');
        }
    }

    public function customerAccount()
    {
        return view('user.components.customer_account');
    }
}
