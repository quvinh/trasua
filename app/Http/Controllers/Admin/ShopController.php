<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
