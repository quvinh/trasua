<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store()
    {
        return view('admin.components.store.store');
    }

    public function import()
    {
        return view('admin.components.store.import');
    }

    public function coupon()
    {
        return view('admin.components.store.coupon');
    }
}
