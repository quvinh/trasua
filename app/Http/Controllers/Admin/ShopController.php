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
        $revenue = DB::table('bills')
            ->select(DB::raw('sum(bills.payment) as revenue'))
            ->whereDate('bills.created_at', $date)
            ->first();

        $numSold = DB::table('bills')
            ->join('bill_infos', 'bills.id_bill', '=', 'bill_infos.id_bill')
            ->select(DB::raw('count(bill_infos.id_product) as sold'))
            ->whereDate('bills.created_at', $date)
            ->first();
        return response()->json([
            'revenue' => $revenue->revenue,
            'numSold' => $numSold->sold
        ]);
    }

    public function revenueMonth($month)
    {
        $sMonth = explode('-', $month);
        $m = $sMonth[0];
        $y = $sMonth[1];
        $revenue = DB::table('bills')
            ->select(DB::raw('sum(bills.payment) as revenue'))
            ->whereMonth('created_at', $m)
            ->whereYear('created_at', $y)
            ->first();

        $numSold = DB::table('bill_infos')
            ->select(DB::raw('count(bill_infos.id_product) as sold'))
            ->where('month', $month)
            ->first();

        $listDonut = DB::table('bill_infos')
            ->join('products', 'bill_infos.id_product', '=', 'products.id_product')
            ->select('bill_infos.id_product as id_product', 'products.name as name', DB::raw('sum(bill_infos.amount) as amount'), DB::raw('sum(bill_infos.amount) * products.price as money'))
            ->groupBy('id_product', 'name', 'products.price')
            ->where('month', $month)
            ->get();

        $listBar = DB::table('bills')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('sum(payment) as money'))
            ->groupBy('day')
            ->whereMonth('created_at', $m)
            ->whereYear('created_at', $y)
            ->get();
        // dd($listDonut, $listBar);
        return response()->json([
            'revenue' => $revenue->revenue,
            'numSold' => $numSold->sold,
            'donut' => $listDonut,
            'bar' => $listBar
        ]);
    }

    public function revenueYear($year)
    {
        // ->where(DB::raw('substr(month, 4)'), '=', $year)
        $revenue = DB::table('bills')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(bills.payment) as revenue'))
            ->groupBy('month')
            ->get();
        return response()->json([
            'revenue' => $revenue,
        ]);
    }
}
