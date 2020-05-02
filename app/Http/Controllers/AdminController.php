<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Category;
use App\Product;
use App\Order_detail;
use App\Order;
use App\Detail;
use Image;
use File;

class AdminController extends Controller
{

    public function index()
    {
        return view('layouts/admin/dashboard-a');
    }

    public function userIndex()
    {
        $user = User::where('role', 1)->get();
        $user2 = User::where('role', 2)->get();

        return view('layouts/admin/user/index' , compact('user', 'user2'));
    }

    public function userStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|min:8',
            'phone' => 'required',
            'photo' => 'nullable|image',
            'role' => 'required',
        ]);

        $photo = null;

        if($request->hasFile('photo')){

            $photo = $this->userFile($request->name , $request->file('photo'));
        }

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'photo' => $photo,
            'role' => $request->role,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil DiInput']);
    }

    public function userEdit($id_user)
    {
        $user = User::findOrFail($id_user);

        return view('layouts/admin/user/edit' , compact('user'));
    }

    public function userUpdate(Request $request, $id_user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|min:8',
            'phone' => 'required',
            'photo' => 'nullable|image',
        ]);

        $user = User::findOrFail($id_user);
        $photo = $user->photo;
        $role = $user->role;

        if($request->hasFile('photo')){
            !empty($photo) ? File::delete(public_path('uploads/user/' . $photo)) : null;

            $photo = $this->userFile($request->name , $request->file('photo'));
        }

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'photo' => $photo,
            'role' => $role,
        ]);

        return redirect(route('users.index'))->with(['success' => 'Data Berhasil Di Edit']);
    }

    public function userDestroy($id_user)
    {
        $user = User::findOrFail($id_user);

        if(!empty($user->photo)){
            File::delete(public_path('uploads/user/' . $user->photo));
        }

        $user->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function userFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/user');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->fit(200)->save($path . '/' . $images);

        return $images;
    }

    public function categoryIndex()
    {
        $cat = Category::all();

        return view('layouts/admin/category/index', compact('cat'));
    }

    public function categoryStore(Request $request)
    {
        $cat = $request->validate([
            'nama_category' => 'required|string',
            'photo_category' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $photo = null;

        if($request->hasFile('photo_category')){
            $photo = $this->categoryFile($request->name , $request->file('photo_category'));
        }

        $cat = Category::create([
            'nama_category' => $request->nama_category,
            'photo_category' => $photo,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil Di Input']);
    }

    public function categoryEdit($id_category)
    {
        $cat = Category::findOrFail($id_category);

        return view('layouts/admin/category/edit', compact('cat'));
    }

    public function categoryUpdate(Request $request, $id_category)
    {
        $cat = $request->validate([
            'nama_category' => 'required|string',
            'photo_category' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $cat = Category::findOrFail($id_category);
        $photo = $cat->photo_category;

        if($request->hasFile('photo_category')){
            !empty($photo) ? File::delete(public_path('uploads/cat/' . $photo)) : null;

            $photo = $this->categoryFile($request->name , $request->file('photo_category'));
        }

        $cat->update([
            'nama_category' => $request->nama_category,
            'photo_category' => $photo,
        ]);

        return redirect(route('cat.i_admin'))->with(['success' => 'Data Berhasil Di Edit']);
    }

    public function categoryDestroy($id_category)
    {
        $cat = Category::findOrFail($id_category);

        if(!empty($cat->photo_category)){
            File::delete(public_path('uploads/cat/' . $cat->photo_category));
        }

        $cat->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Di Delete']);
    }

    public function categoryFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/cat');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->fit(200)->save($path . '/' . $images);

        return $images;
    }

    public function productIndex()
    {
        $product = Product::all();
        $cat = Category::all();

        return view('layouts/admin/product/index', compact('product', 'cat'));
    }

    public function productStore(Request $request)
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
            $photo = $this->productFile($request->name , $request->file('photo_product'));
        }

        $product = Product::create([
            'nama_product' => $request->nama_product,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo_product' => $photo,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil Di Input']);
    }

    public function productEdit($id_product)
    {
        $product = Product::findOrFail($id_product);
        $cat = Category::all();

        return view('layouts/admin/product/edit', compact('product', 'cat'));
    }

    public function productUpdate(Request $request, $id_product)
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

            $photo = $this->productFile($request->nama_product , $request->file('photo_product'));
        }

        $product->update([
            'nama_product' => $request->nama_product,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo_product' => $photo,
        ]);

        return redirect(route('product.i_admin'))->with(['success' => 'Data Berhasil Di edit']);
    }

    public function productDestroy($id_product)
    {
        $product = Product::findOrFail($id_product);

        if(!empty($product->photo_product)){
            File::delete(public_path('uploads/product/' . $product->photo_product));
        }

        $product->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function productFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->fit(200)->save($path . '/' . $images);

        return $images;
    }


    public function orderIndex()
    {
        $order = Order::where('status', 1)->get();
        $orders = Order::where('status', 2)->get();

        return view('layouts/admin/order/index', compact('order', 'orders'));
    }

    public function orderComplete($id_order)
    {
        $order = Order::findOrFail($id_order);

        $order->update([
            'status' => 1,
        ]);

        return redirect()->back()->with(['success' => 'Orderan Telah Dielesaikan']);
    }

    public function orderDestroy($id_order)
    {
        $order = Order::findOrFail($id_order);
        $detail = Order_detail::where('order_id', $id_order);

        $order->delete();
        $detail->delete();

        return redirect()->back()->with(['success' => 'Orderan Telah Dihapus']);
    }

    public function orderDetail($id_order)
    {
        $order = Order_detail::where('order_id', $id_order)->get();
        $nomor = Order::where('id_order', $id_order)->value('order_number');

        return view('layouts/admin/order/detail', compact('order', 'nomor'));
    }

}
