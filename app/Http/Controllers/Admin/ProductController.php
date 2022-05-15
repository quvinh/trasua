<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.components.product.add');
    }

    public function storeProduct(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_category' => 'required',
            'id_size' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $image = '';
        if($request->hasFile('image')) {
            $file = $request->file('image');
            dd($file);
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension, 'jpg') === 0 || strcasecmp($extension, 'png') === 0 || strcasecmp($extension, 'jepg') === 0) {
                $name = Str::random(5) . '_' . $name_file;
                while(file_exists('images/product/'.$name)) {
                    $name = Str::random(5) . '_' . $name_file;
                }
                $file->move('images/product/', $name);
                $image = $name;
                dd($name);
            }
        }

        // Product::create($request->all());
        Product::create(array_merge(
            $validator->validated(),
            [
                'amount' => 0,
                'image' => $image,
            ]
        ));

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
    }

    public function manageProduct()
    {
        $product = Product::all();
        return view('admin.components.product.manage', compact('product'));
    }
}
