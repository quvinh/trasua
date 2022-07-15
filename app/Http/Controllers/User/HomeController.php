<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // echo 'Xin chào User, '. $user->name;
        return view('user.layouts.index');
    }

    public function category()
    {
        return view('user.components.category');
    }

    public function searchCategory(Request $request)
    {
        dd($request->all());
    }

    public function getCategory($id)
    {
        $idCategory = $id;
        if(is_numeric($idCategory)) {
            return view('user.components.category', compact('idCategory'));
        } else {
            return view('user.components.category');
        }
    }

    public function getProduct($id)
    {
        $idProduct = $id;
        return view('user.components.product', compact('idProduct'));
    }

    public function needLogin()
    {
        $user = Auth::user();
        echo 'Xin chào User, '. $user->name;
    }
}
