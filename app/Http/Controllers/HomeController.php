<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Order;
use App\Order_detail;
use App\User;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cat = Category::all();
        $prods = Product::where('category_id', '1')->get();
        $prod = Product::all();

        return view('layouts.pelanggan.dashboard', compact('cat', 'prods', 'prod'));
    }

    public function riwayat()
    {
        $order = Order::where('user_id' , Auth::user()->id_user)->orderBy('status')->get();
        $user = User::where('id_user', Auth::user()->id_user)->get();

        return view('layouts.pelanggan.riwayat', compact('order', 'user'));
    }

    public function detailRiwayat($id_order)
    {
        $order = Order_detail::where('order_id', $id_order)->get();
        $nomor = Order::where('id_order', $id_order)->value('order_number');
        $tgl = Order::where('id_order', $id_order)->value('created_at');
        $user = User::where('id_user', Auth::user()->id_user)->get();

        return view('layouts.pelanggan.detailRiwayat', compact('order', 'nomor', 'tgl', 'user'));
    }
}
