<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $tusers = User::all()->count();
        $users = User::where('usertype', 'user')->get()->count();
        $admins = $tusers-$users;
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $delivered = Order::where('status', 'delivered')->get()->count();
        return view('admin.index', compact('users','admins', 'products', 'orders', 'delivered'));
    }

    public function home() {
        $products = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }
        else
        $count = 0;
        return view('home.index', compact('products', 'count'));
    }

    public function login_home() {
        $products = Product::all();
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        return view('home.index', compact('products', 'count'));
    }

    public function product_details($id) {
        $product = Product::find($id);
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }
        else
        $count = 0;
        return view('home.product_details', compact('product', 'count'));
    }

    public function add_to_cart($id) {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $purchases = new Cart;
        $purchases->user_id = $user_id;
        $purchases->product_id = $product_id;
        $purchases->save();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('item added to cart');
        return redirect()->back();
    }

    public function mycart() {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
        }
        return view('home.mycart', compact('count', 'cart'));
    }

    public function myorders(){
        $user = Auth::user();
        $count = Cart::where('user_id', $user->id)->get()->count();
        $orders = Order::where('user_id', $user->id)->get();
        return view('home.orders', compact('count', 'orders'));
    }

    public function delete_cart($id) {
        $cart = Cart::find($id);
        $cart->delete();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('product removed from cart');
        return redirect()->back();
    }

    public function make_order(Request $request) {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();
        foreach($cart as $cart){
            $order = new Order;
            $order->name = $name;
            $order->address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $cart->product_id;
            $order->save();
        }
        $cart_remove = Cart::where('user_id', $userid)->get();
        foreach($cart_remove as $remove){
            $cart = Cart::find($remove->id);
            $cart->delete();
        }
        return redirect()->back();
    }
}
