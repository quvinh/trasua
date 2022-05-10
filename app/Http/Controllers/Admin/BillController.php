<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
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
