<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'product_name', 'product_desc', 'product_status','product_weight','product_price','product_qty'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_products';

    public function category(){
        return $this ->belongsTo('App\Models\Category','category_id');
    }
    public function product_imgs(){
        return $this ->hasMany('App\Models\ProductImages','product_id');
    }
}
