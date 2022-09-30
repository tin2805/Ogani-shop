<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use Session;

session_start();
class ProductController extends Controller
{
    //
    public function add_product(){
        $category = Category::all();
        return view('admin.admin_add_product')->with(compact('category'));
    }
    public function show_product(Request $request){
        // $product = Product::find(4);
        // return $product->category;
        $categories = Category::all();
        $products = Product::all();
        if($products){
            if(isset($_GET['sort-by-cate'])){
                $sort_by_cate = $_GET['sort-by-cate'];
                for($i = 0; $i < count($categories); $i++){
                    if($sort_by_cate=='all'){
                        $products = Product::all();
                    }
                    elseif($sort_by_cate == $categories[$i]->category_id){
                        $products = Category::find($sort_by_cate)->products;
                    }
                }
            }
            else{
                $products = Product::all();
            }
            // return $products[0]->category_id;
            // return $categories->category_id;
            return view('admin.admin_show_product')->with(compact('products','categories'));
        }
        else{
            $products = new Product();
            return view('admin.admin_show_product')->with(compact('products','categories'));
        }



    }
    public function save_product(Request $request){
        $data = $request->all();

        $product = new Product();
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_title'];
        $product->product_price = $data['product_price'];
        $product->product_weight = $data['product_weight'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];
        $product->product_feature = 0;

        $product->save();

        $get_images = $request->file('product_imgs');
        // return $get_images;
        if(($request->hasfile('product_imgs'))){
            foreach($get_images as $file){
                $get_name_image = str_replace(' ','',$data['product_title']);
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$file->getClientOriginalExtension();
                $file->move('public/uploads/admin/products',$new_image);
                // $product_imgs[] = $new_image;
                $product_imgs = new ProductImages();
                $product_imgs->product_id = $product->product_id;
                $product_imgs->product_imgs_img = $new_image;
                $product_imgs->save();
            }
        }
        else{
            $product_imgs[] = '';
        }
        Session::put('message','Add Product Success');
        return Redirect('/admin/add-product');
    }
    public function edit_product($product_id){
        $edit_product = Product::where('product_id',$product_id)->first();
        $category = Category::all();
        $old_img = ProductImages::where('product_id',$product_id)->get();
        return view('admin.admin_edit_product')->with(compact('edit_product','category','old_img'));
    }
    public function update_product(Request $request,$product_id){
        $data = $request->all();

        $product = Product::where('product_id',$product_id)->first();
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_title'];
        $product->product_price = $data['product_price'];
        $product->product_weight = $data['product_weight'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];
        $product->product_feature = 0;

        $product->update();

        $get_images = $request->file('product_imgs');
        // return $get_images;
        if(($request->hasfile('product_imgs'))){
            $old_img = ProductImages::where('product_id',$product_id)->get();
            foreach($old_img as $img){
                unlink('public/uploads/admin/products/'.$img->product_imgs_img);
            }
            ProductImages::where('product_id',$product_id)->delete();
            foreach($get_images as $file){
                $get_name_image = str_replace(' ','',$data['product_title']);
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$file->getClientOriginalExtension();
                $file->move('public/uploads/admin/products',$new_image);
                // $product_imgs[] = $new_image;
                $product_imgs = new ProductImages();
                $product_imgs->product_id = $product_id;
                $product_imgs->product_imgs_img = $new_image;
                $product_imgs->save();
            }
        }
        else{
            return Redirect('/admin/show-product');
        }
        return Redirect('/admin/show-product');
    }
    public function update_status_product($product_id){
        $product_status = Product::where('product_id', $product_id)->first();
        if($product_status->product_status == 1){
            $product_status['product_status'] = 0;
            $product_status->update();
        }
        else{
            $product_status['product_status'] = 1;
            $product_status->update();
        }
        return Redirect('/admin/show-product');

    }
    public function update_feature_product(Request $request,$product_id){
        $product_feature = Product::where('product_id', $product_id)->first();
        // $url = $_GET['sort-by-cate'];
        // $url = $request->url();
        // return $url;
        // if(isset($_GET['sort-by-cate'])){
        //     $sort_by = $_GET['sort-by-cate'];
        //     for($i = 0; $i < count($categories); $i++){
        //         if($sort_by=='all'){
        //             $products = Product::all();
        //         }
        //         elseif($sort_by == $categories[$i]->category_id){
        //             $products = Category::find($sort_by)->products;
        //         }
        //     }
        // }
        if($product_feature->product_feature == 1){
            $product_feature['product_feature'] = 0;
            $product_feature->update();
        }
        else{
            $product_feature['product_feature'] = 1;
            $product_feature->update();
        }
        return Redirect('/admin/show-product');

    }
    public function delete_product($product_id){
        Product::where('product_id', $product_id)->delete();
        ProductImages::where('product_id', $product_id)->delete();
        return Redirect('/admin/show-product');
    }
}
