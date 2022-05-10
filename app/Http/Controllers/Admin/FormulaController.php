<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    public function addFormula()
    {
        return view('admin.components.formula.add');
    }

    public function manageFormula()
    {
        return view('admin.components.formula.manage');
    }
}
