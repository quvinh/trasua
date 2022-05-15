<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Size;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category()
    {
        $category = Category::all();
        $size = Size::all();
        return view('admin.components.category.category', compact('category', 'size'));
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Category::create(['name' => $request->category]);

        return redirect()->back()->with('success', 'Thêm loại sản phẩm thành công');
    }

    public function addSize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'capacity' => 'required|numeric|min:0|max:1000'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Size::create(['name' => $request->size, 'capacity' => $request->capacity]);
        Size::create($request->all());
        return redirect()->back()->with('success', 'Thêm kích thước thành công');
    }

    public function unit()
    {
        $unit = Unit::all();
        return view('admin.components.category.unit', compact('unit'));
    }

    public function addUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Unit::create($request->all());

        return redirect()->back()->with('success', 'Thêm đơn vị tính thành công');
    }
}
