<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Image;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return view('layouts/pelanggan/product', compact('product'));
    }

    public function i_admin()
    {
        $product = Product::all();
        $cat = Category::all();

        return view('layouts/admin/product/index', compact('product', 'cat'));
    }

    public function indexPilihan($id_category)
    {
        $product  = Product::where('category_id', $id_category)->get();
        $category = Category::where('id_category', $id_category)->value('nama_category');
        $photo    = Category::where('id_category', $id_category)->value('photo_category');
        $id    = Category::where('id_category', $id_category)->value('id_category');

        return view('layouts/pelanggan/product-p', compact('product', 'category', 'photo', 'id'));
    }

    public function search(Request $request, $id_category)
    {
        $cari = $request->search;

        $category = Category::where('id_category', $id_category)->value('nama_category');
        $photo    = Category::where('id_category', $id_category)->value('photo_category');
        $id    = Category::where('id_category', $id_category)->value('id_category');
        $product = Product::where('nama_product', 'like', '%'.$cari.'%')->get();

        return view('layouts/pelanggan/product-p', compact('product', 'category', 'photo', 'id'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_product' => 'required|string|max:100',
            'category_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'photo_product' => 'nullable|image',
        ]);

        $photo = null;

        if($request->hasFile('photo_product')){
            $photo = $this->saveFile($request->name , $request->file('photo_product'));
        }

        $product = Product::create([
            'nama_product' => $request->nama_product,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo_product' => $photo,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil DiInput']);
    }

    public function edit($id_product)
    {
        $product = Product::findOrFail($id_product);
        $cat = Category::all();

        return view('layouts/admin/product/edit', compact('product', 'cat'));
    }

    public function update(Request $request, $id_product)
    {
        $data = $request->validate([
            'nama_product' => 'required|string|max:100',
            'category_id' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'photo_product' => 'nullable|image',
        ]);

        $product = Product::findOrFail($id_product);
        $photo = $product->photo_product;

        if($request->hasFile('photo_product')){
            !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)) : null;

            $photo = $this->saveFile($request->nama_product , $request->file('photo_product'));
        }

        $product->update([
            'nama_product' => $request->nama_product,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo_product' => $photo,
        ]);

        return redirect(route('product.index'))->with(['success' => 'Data Berhasil Di edit']);
    }

    public function destroy($id_product)
    {
        $Product = Product::findOrFail($id_product);

        if(!empty($product->photo_product)){
            File::delete(public_path('uploads/product/' . $product->photo_product));
        }

        $product->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil DiInput']);
    }

    public function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->save($path . '/' . $images);

        return $images;
    }

}
