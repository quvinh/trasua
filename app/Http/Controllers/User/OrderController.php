<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request) {
        if ($request->getMethod() == 'GET') {
            return view('user.components.order');
        }
        
        $validator = Validator::make($request->all(), [
            // 'created_by' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
    }
}
