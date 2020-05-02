<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Order_detail;
use DB;
use Session;
use Auth;

class CartController extends Controller
{
    public function index()
    {
    	return view('layouts.pelanggan.cart');
    }

    public function add(Request $request)
    {
        $id_product = $request->id;
        $product = Product::findOrFail($id_product);

        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $id_product => [
                        "id_prod" => $product->id_product,
                        "name" => $product->nama_product,
                        "amount" => $product->amount,
                        "quantity" => 1,
                        "price" => $product->price,
                        "photo" => $product->photo_product
                    ]
            ];

            session()->put('cart', $cart);

            return true;
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id_product])) {

            $cart[$id_product]['quantity']++;

            session()->put('cart', $cart);

            return true;

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id_product] = [
            "id_prod" => $product->id_product,
            "name" => $product->nama_product,
            "amount" => $product->amount,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo_product
        ];

        session()->put('cart', $cart);

        return true;
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }

        return view('layouts.pelanggan.cart');
    }

    public function remove($id_product)
    {
        if($id_product) {

            $cart = session()->get('cart');

            if(isset($cart[$id_product])) {

                unset($cart[$id_product]);

                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }

        return redirect()->back();
    }

    public function order(Request $request)
    {
        $this->validate($request, [
            'city' => 'required',
            'address' => 'required',
            'description' => 'nullable',
        ]);

        $cart = Session::get('cart');

        $total_harga = 0;
        $quantity = 0;

        foreach ($cart as $data) {
            $total_harga += $data['price'] * $data['quantity'];
            $quantity += $data['quantity'];
        }

        //random number between 100 - 999 (3 digit)
        $random = mt_rand(100, 999);
        $order_number = $random . time();

        $new = new Order();
        $new->user_id = Auth::user()->id_user;
        $new->order_number = $order_number;
        $new->status = 2;
        $new->city = $request['city'];
        $new->address = $request['address'];
        $new->description = $request['description'];
        $new->total_quantity = $quantity;
        $new->total_price = $total_harga;
        $new->save();

        $order_id = DB::getPdo()->lastInsertId();

        foreach ($cart as $data) {
            $total_harga2 = $data['price'] * $data['quantity'];

            $OrderPro = new Order_detail;
            $OrderPro->order_id = $order_id;
            $OrderPro->product_id = $data['id_prod'];
            $OrderPro->quantity = $data['quantity'];
            $OrderPro->total_price = $total_harga2;
            $OrderPro->save();
        }

        Session::forget('cart');
        sleep(3);
        return redirect()->route('home');
    }

    public function cartlive()
    {
        $cart = count((array) session()->get('cart'));

        return $cart;
    }
}
