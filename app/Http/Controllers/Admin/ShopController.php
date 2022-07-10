<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function revenue()
    {
        return view('admin.components.shop.revenue');
    }

    public function expense()
    {
        return view('admin.components.shop.expense');
    }

    public function branch()
    {
        return view('admin.components.shop.branch');
    }

    public function revenueDate($date)
    {
        $bill = DB::table('bills')
            ->join('bill_infos', 'bills.id_bill', '=', 'bill_infos.id_bill')
            // ->join('products', 'bill_infos.id_product', '=', 'products.id_product')
            ->select(DB::raw('DATE(bills.created_at) as date'),
                DB::raw('sum(bills.payment) as revenue'), 
                // DB::raw('count(products.id_product) as sold')
                )
            ->groupBy('date')
            ->whereDate('bills.created_at', $date)
            ->get();
        
        dd($bill);
    }
}
