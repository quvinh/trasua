<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FormulaController extends Controller
{
    public function addFormula()
    {
        return view('admin.components.formula.add');
    }

    public function storeFormula(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nameFormula' => 'required',
            'id_category' => 'required',
            'id_size' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $name = $request->name;
        $capacity = $request->capacity;
        $id_unit = $request->id_unit;
        $count = count(array_values(array_filter($name)));
        if($count > 0) {
            for($i=0; $i<$count; $i++) {
                if($name[$i] == null || $capacity[$i] == null || $id_unit[$i] == null || !is_numeric($capacity[$i])) {
                    return redirect()->back()->withErrors(['msg' => 'Thành phẩm nhập vào không đúng']);
                }
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Thành phẩm nhập vào không đúng']);
        }

        DB::table('formulas')->insert([
            [
                'id_category' => $request->id_category,
                'name' => $request->nameFormula,
                'status' => 0
            ]
        ]);

        $id_formula = DB::table('formulas')->max('id_formula');
        $id_structure = DB::table('structures')->max('id_structure');
        $array_structure = array();
        $array_formula_detail = array();
        for($i=0; $i<$count; $i++) {
            $id_structure += 1;
            array_push($array_structure, [
                'id_structure' => $id_structure,
                'id_size' => $request->id_size,
                'id_unit' => $id_unit[$i],
                'name' => $name[$i],
                'capacity' => $capacity[$i]
            ]);
            array_push($array_formula_detail, [
                'id_formula' => $id_formula,
                'id_structure' => $id_structure
            ]);
        }
        DB::table('structures')->insert($array_structure);
        DB::table('formula_structures')->insert($array_formula_detail);
        return redirect()->back()->with(['success' => 'Thêm công thức thành công']);
    }

    public function manageFormula()
    {
        $formula = DB::table('formulas')
            ->join('categories', 'formulas.id_category', '=', 'categories.id_category')
            ->select('formulas.*', 'categories.name as category')
            ->orderByDesc('formulas.id_formula')
            ->get();
        return view('admin.components.formula.manage', compact('formula'));
    }

    public function editFormula($id)
    {
        $formula = DB::table('formulas')->where('id_formula', $id)->first();
        return view('admin.components.formula.edit', compact('formula'));
    }
}
