<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class HomeController extends Controller
{
    //
    public function index(){
        $categories = Category::where('category_status', 1)->limit(5)->get();  
        return view('layout')->with(compact('categories'));
    }
    public function homepage(){
        $categories = Category::where('category_status', 1)->limit(5)->get();
        $feature_product = Product::where('product_feature',0)->limit(4)->get();
        $lated_product = Product::orderby('product_id','DESC')->limit(6)->get();
        // return $lated_product->slice(0,3);
        // return $lated_product;
        // $product_img = ProductImages::all();
        // return str_replace(' ','',$);
        return view('pages.homepage')->with(compact('categories','feature_product','lated_product'));
    }
    public function shop_grid(){
        $categories = Category::get();
        $products = Product::all();
        $min_price = 0;
        $max_price = 2000;
        if($products){
            if(isset($_GET['sort-by-name'])){
                $sort_by_name = $_GET['sort-by-name'];
                for($i = 0; $i < count($products); $i++){
                    if($sort_by_name=='all'){
                        $products = Product::all();
                    }
                    elseif($sort_by_name == 'z-a'){
                        $products = Product::orderBy('product_name','DESC')->get();
                    }
                    elseif($sort_by_name == 'a-z'){
                        $products = Product::orderBy('product_name','ASC')->get();
                    }
                    elseif($sort_by_name == 'price-dec'){
                        $products = Product::orderBy('product_price','ASC')->get();
                    }
                    elseif($sort_by_name == 'price-asc'){
                        $products = Product::orderBy('product_price','ASC')->get();
                    }
                }
            }
            elseif(isset($_GET['start-price']) && $_GET['end-price']){
                $min_price = $_GET['start-price'];
                $max_price = $_GET['end-price'];
                $products = Product::whereBetween('product_price',[$min_price,$max_price])->orderBy('product_id','ASC')->get();
            }
            else{
                $products = Product::all();
            }
        }
        return view('pages.shop_grid')->with(compact('categories','products','min_price','max_price'));
    }
    public function show_login(){
        return view('pages.show_login');
    }
    public function login(Request $request){
        $login = $request->all();
        $valid_user = Users::where('user_email',$login['email'])->where('user_password', md5($login['pass']))->first();
        if($valid_user){
            Session::put('user_id',$valid_user->user_id);
            Session::put('user_name',$valid_user->user_name);
            Session::put('user_ava',$valid_user->user_ava);
            return Redirect('/');
        }
        else{
            Session::put('message','Wrong Password or Email');
            return Redirect('/show-login');
        }
    }
    public function show_register(){
        $user = new Users();
        return view('pages.show_register')->with(compact('user'));
    }
    public function register(Request $request){
        $data = $request->all();
        $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/pages/user',$new_image);
            $data['avatar'] = $new_image;
        }
        else{
            $data['avatar'] = 'defaut.jpg';
        }
        $user = new Users();
        $user->user_name = $data['username'];
        $user->user_email = $data['email'];
        $user->user_password = md5($data['password']);
        $user->user_phone = $data['phone'];
        $user->user_ava =  $data['avatar'];
        if(md5($data['password']) == md5($data['confpass'])){
            $user->save();
        }
        else{
            Session::put('message','wrong confirm password');
            return view('pages.show_register')->with(compact('user'));
        }
        return view('pages.show_login');
    }
    public function sort_by_cate($category_id){
        $categories = Category::get();
        $products = Product::with('category')->where('category_id',$category_id)->get();
        $min_price = 0;
        $max_price = 2000;
        if($products){
            if(isset($_GET['sort-by-name'])){
                $sort_by_name = $_GET['sort-by-name'];
                for($i = 0; $i < count($products); $i++){
                    if($sort_by_name=='all'){
                        $products = Product::with('category')->where('category_id',$category_id)->get();
                    }
                    elseif($sort_by_name == 'z-a'){
                        $products = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','DESC')->get();
                    }
                    elseif($sort_by_name == 'a-z'){
                        $products = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','ASC')->get();
                    }
                    elseif($sort_by_name == 'price-dec'){
                        $products = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->get();
                    }
                    elseif($sort_by_name == 'price-asc'){
                        $products = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->get();
                    }
                }
            }
            elseif(isset($_GET['start-price']) && $_GET['end-price']){
                $min_price = $_GET['start-price'];
                $max_price = $_GET['end-price'];
                $products = Product::with('category')->where('category_id',$category_id)->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_id','ASC')->get();
            }
            else{
                $products = Product::with('category')->where('category_id',$category_id)->get();
            }
        }
        return view('pages.shop_grid')->with(compact('products','categories','min_price','max_price'));
    }
    public function shop_detail($product_id){
        $categories = Category::get();
        $product = Product::with('product_imgs')->where('product_id',$product_id)->first();
        $related_products = Category::with('products')->where('category_id',$product->category_id)->first();
        // return $related_product->products;
        $related_product_img = Product::with('product_imgs')->where('product_id',$related_products->products[0]->product_id)->first();
        // return $related_product_img->product_imgs;
        return view('pages.shop_detail')->with(compact('categories','product','related_products','related_product_img'));
    }
    public function show_blog(){
        $categories = Category::get();
        return view('pages.blog')->with(compact('categories'));
    }
    public function show_checkout(){
        $categories = Category::get();
        return view('pages.checkout')->with(compact('categories'));
    }
    public function show_contact(){
        $categories = Category::get();
        return view('pages.contact')->with(compact('categories'));
    }
}
