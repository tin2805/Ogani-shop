<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Session;
use Cart;

session_start();
class CartController extends Controller
{
    //
    public function shop_cart(){
        $categories = Category::get();
        $title = 'Shop Cart';
        return view('cart.shop_cart')->with(compact('categories','title'));
    }
    public function save_cart(Request $request){
        $categories = Category::get();
        $product = $request->all();
        $quantity = $product['qty'];
        $product_id = $product['product_id_hidden'];
        $products  = Product::where('product_id', $product_id)->first();
        $data['id'] = $products->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $products->product_name;
        $data['price'] = $products->product_price;
        $data['weight'] = $products->product_weight;
        $data['options']['image'] = $products->product_imgs->first()->product_imgs_img;
        Cart::add($data);
        // return view('cart.shop_cart')->with(compact('products','categories'));
        return Redirect::to('/shop-cart');
    }
    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->qty_cart;
        Cart::update($rowId,$qty);
        return Redirect::to('/shop-cart');
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/shop-cart');
    }

}
