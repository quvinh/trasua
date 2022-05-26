<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function manageProduct()
    {
        return view('admin.components.product.manage');
    }
    public function addProduct()
    {
        return view('admin.components.product.add');
    }

    public function storeProduct(Request $request)
    {
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
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if(strcasecmp($extension, 'jpg') === 0 || strcasecmp($extension, 'png') === 0 || strcasecmp($extension, 'jepg') === 0) {
                $name = Str::random(5) . '_' . $name_file;
                while(file_exists('images/product/'.$name)) {
                    $name = Str::random(5) . '_' . $name_file;
                }
                $file->move('images/product/', $name);
                $image = $name;
            }
        }
        // Product::create($request->all());
        Product::create(array_merge(
            $validator->validated(),
            [
                'amount' => 0,
                'visible' => 1,
                'image' => $image,
                'description' => $request->description,
            ]
        ));

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
    }

    public function getProduct()
    {
        $product = Product::orderBy('id_product','DESC')->get();
        // return view('admin.components.product.manage', compact('product'));
        return response()->json([
            'product' => $product,
        ]);
    }

    public function editProduct($id)
    {
        $product = DB::table('products')->where('id_product', $id)->first();
        // return view('admin.components.product.edit', compact('product'));
        return response()->json([
            'product' => $product,
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
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
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $product = DB::table('products')->where('id_product', $id);

            if(strcasecmp($extension, 'jpg') === 0 || strcasecmp($extension, 'png') === 0 || strcasecmp($extension, 'jepg') === 0) {
                $name = Str::random(5) . '_' . $name_file;
                while(file_exists('images/product/'.$name)) {
                    $name = Str::random(5) . '_' . $name_file;
                }
                $file->move('images/product/', $name);
                $image = $name;
            }
            if(file_exists('images/product/'.$product->first()->image))
            {
                File::delete('images/product/'.$product->first()->image);
            }
        }
        Product::where('id_product', $id)->update(array_merge(
            $validator->validated(),
            [
                'amount' => 0,
                'image' => $image,
                'description' => $request->description,
            ]
        ));

        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function updateVisibleProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'visible' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Product::where('id_product', $id)->update(array_merge(
            $validator->validated(),
        ));
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật sản phẩm thành công',
        ]);
    }

    public function deleteProduct($id)
    {
        $product = DB::table('products')->where('id_product', $id);
        if(file_exists('images/product/'.$product->first()->image))
        {
            File::delete('images/product/'.$product->first()->image);
        }
        $product->delete();
        // return redirect()->back()->with('success', 'Xoá sản phẩm thành công');
        return response()->json([
            'status' => 'success',
            'message' => 'Xoá bàn thành công',
        ]);
    }
}
