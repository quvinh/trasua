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
        return view('welcome');
    }

    public function needLogin()
    {
        $user = Auth::user();
        echo 'Xin chào User, '. $user->name;
    }
}
