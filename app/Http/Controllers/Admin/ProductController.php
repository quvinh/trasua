<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.components.product.add');
    }

    public function manageProduct() 
    {
        return view('admin.components.product.manage');
    }
}
