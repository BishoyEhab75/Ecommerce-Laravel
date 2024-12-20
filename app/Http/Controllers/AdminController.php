<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {

        $data = Category::all();
        return view('admin.categories.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->Category_name = $request->category;
        //object from model -> DB column(as model) = $request -> name from the form
        $category->save();
        toastr()->positionClass('toast-bottom-right')->success($request->category . ' added successfully');
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.categories.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success($request->category . ' updated successfully');
        return redirect('/view_category');
    }

    public function add_product()
    {
        $category = Category::all();
        return view('admin.products.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $image = $request->image;
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $image_name);
            $product->image = $image_name;
        }
        $product->save();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success($product->title . ' added successfully');

        return redirect()->back();
    }

    public function view_product()
    {
        $product = Product::paginate(2);
        return view('admin.products.view_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $image_path = public_path('products/' . $product->image);
        if (file_exists($image_path && $product->image)) {
            unlink($image_path);
        }
        $product->delete();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('product deleted successfully');
        return redirect()->back();
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.products.edit_product', compact('product', 'category'));
    }

    public function update_product($id, Request $request)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        $image = $request->image;
        if ($image) {
            $image_path = public_path('products/' . $product->image);
            if (file_exists($image_path && $product->image)) {
                unlink($image_path);
            }
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $image_name);
            $product->image = $image_name;
        }
        $product->save();
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('product updated successfully');
        return redirect('/view_product');
    }

    public function search_product(Request $request) {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search.'%')->orWhere('category', 'LIKE', '%'.$search.'%')->paginate(2);
        $product->appends(['search' => $search]);
        return view('admin.products.view_product', compact('product'));
    }

    public function view_orders() {
        $orders = Order::all();
        $time = $orders[0]->created_at;
        $array = [];
        $counter=0;
        foreach($orders as $order)
        {
            if($time == $order->created_at)
            {

                if (!isset($array[$counter])) {
                    $array[$counter] = [];
                }
                array_push($array[$counter], $order);
            }
            else
            {
                $time = $order->created_at;
                $counter++;
                if (!isset($array[$counter])) {
                    $array[$counter] = [];
                }
                array_push($array[$counter], $order);
            }
        }
        return view('admin.orders', compact('orders', 'array'));
    }

    // public function on_the_way($id) {
    //     $order = Order::find($id);
    //     $order->status = "On The Way";
    //     $order->save();
    //     toastr()->closeButton()->positionClass('toast-bottom-right')->success('order status updated');
    //     return redirect()->back();
    // }
    public function on_the_way($id) {
        $idsArray = explode(',', $id);
        foreach($idsArray as $id)
        {
            $order = Order::find($id);
            $order->status = "On The Way";
            $order->save();
        }
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('order status updated');
        return redirect()->back();
    }

    public function delivered($id) {
        $idsArray = explode(',', $id);
        foreach($idsArray as $id)
        {
            $order = Order::find($id);
            $order->status = "Delivered";
            $order->save();
        }
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('order status updated');
        return redirect()->back();
    }

    public function cancelled($id) {
        $idsArray = explode(',', $id);
        foreach($idsArray as $id)
        {
            $order = Order::find($id);
            $order->status = "Cancelled";
            $order->save();
        }
        toastr()->closeButton()->positionClass('toast-bottom-right')->success('order status updated');
        return redirect()->back();
    }
}
