<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Product;
use Session;
use Illuminate\Support\Facades\Redirect;
use Mockery\Undefined;

session_start();
class AdminController extends Controller
{
    public function Authlogin(){
        $valid_id = Session::get('admin_id');
        if(!$valid_id){
            return redirect::to('/admin/show-login')->send();
        }
        else{
            return $this;
        }
    }
    //ADMIN
    public function index(){
        $this->Authlogin();
        return view('admin_layout');
    }
    public function show_login(){
        return view('admin.admin_login');
    }
    public function login(Request $request){
        $data = $request->all();

        $admin_valid = Admin::where('admin_email',$data['admin_email'])->where('admin_password',md5($data['admin_password']))->first();
        // return $admin_valid;
        if($admin_valid){
            Session::put('admin_id', $admin_valid['admin_id']);
            Session::put('admin_name', $admin_valid['admin_name']);
            Session::put('admin_email', $admin_valid['admin_email']);
            Session::put('admin_ava', $admin_valid['admin_ava']);
            return Redirect('admin/dashboard');
        }
        else{
            Session::put('message', 'invalid password or email');
            return Redirect('/admin/show-login');
        }
    }
    public function show_register(){
        return view('admin.admin_register');
    }
    public function register(Request $request){
        $data = $request->all();
        $get_image = $request->file('admin_ava');
        $valid_email = Admin::where('admin_email',$data['admin_email'])->first();
        // return $valid_email;
        if($valid_email){
            Session::put('message','E-mail is being used');
            return Redirect::to('/admin/show-register');
        }
        else{
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/admin',$new_image);
                $data['admin_ava'] = $new_image;
            }
            else{
                $data['admin_ava'] = '';
            }
            $admin = new Admin();
            $admin->admin_name = $data['admin_name'];
            $admin->admin_email = $data['admin_email'];
            $admin->admin_password = md5($data['admin_password']);
            $admin->admin_phone = $data['admin_phone'];
            $admin->admin_ava =  $data['admin_ava'];
    
            $admin->save();
            return view('admin.admin_login');
        }

    }
    public function logout(){
        Session::put('admin_id', '');
        Session::put('admin_name', '');
        Session::put('admin_email', '');
        Session::put('admin_ava', '');
        return Redirect('/admin/show-login');
    }
    public function dashboard(){
        $this->Authlogin();
        return view('admin.admin_dashboard');
    }
    //CATEGORY
    public function add_category(){
        $this->Authlogin();
        $edit_category = new Category();
        $edit_category['category_name'] = '';
        $edit_category['category_desc'] = '';
        $edit_category['category_status'] = 1;
        $edit_category['category_ava'] = '';
        return view('admin.admin_add_edit_categories')->with(compact('edit_category'));
    }
    public function save_category(Request $request){
        $data = $request->all();
        $get_image = $request->file('category_ava');
        if($get_image){
            $get_name_image = str_replace(' ','',$data['category_title']);
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/admin/categories',$new_image);
            $data['category_ava'] = $new_image;
        }
        else{
            $data['category_ava'] = '';
        }
        $category = new Category();
        $category->category_name = $data['category_title'];
        $category->category_desc = $data['category_desc'];
        $category->category_status = $data['category_status'];
        $category->category_ava =  $data['category_ava'];

        $category->save();

        return Redirect('/admin/add-category');
    }
    public function show_category(){
        $this->Authlogin();
        $all_categories = Category::Orderby('category_id','DESC')->get();
        // $all = Category::find(4);
        // return $all->products;
        return view('admin.admin_show_categories')->with(compact('all_categories'));
    }
    public function update_status($category_id){
        $category = Category::where('category_id',$category_id)->first();
        if($category->category_status == 1){
            $category->category_status = 0;
        }
        else{
            $category->category_status = 1;
        }
        $category->update();
        return Redirect('/admin/show-category');
    }
    public function edit_category($category_id){
        $this->Authlogin();
        $edit_category = Category::where('category_id',$category_id)->first();
        return view('admin.admin_add_edit_categories')->with(compact('edit_category'));
    }
    public function update_category($category_id,Request $request){
        $edit_category = Category::where('category_id',$category_id)->first();

        $data = $request->all();
        $get_image = $request->file('category_ava');
        if($get_image){
            $get_name_image = str_replace(' ','',$data['category_title']);
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/admin/categories',$new_image);
            $data['category_ava'] = $new_image;
        }
        else{
            $data['category_ava'] = $edit_category->category_ava;
        }
        $edit_category->category_name = $data['category_title'];
        $edit_category->category_desc = $data['category_desc'];
        $edit_category->category_status = $data['category_status'];
        $edit_category->category_ava =  $data['category_ava'];

        $edit_category->update();
        return Redirect('/admin/show-category');
    }
    public function delete_category($category_id){
        Category::where('category_id',$category_id)->delete();
        return Redirect('/admin/show-category');
    }
    //PRODUCTS
    public function add_product(){
        $this->Authlogin();
        return view('admin.admin_add_product');
    }

}