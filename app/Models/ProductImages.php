<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'product_imgs_img', 'product_id'
    ];
    protected $primaryKey = 'product_imgs_id';
    protected $table = 'tbl_product_imgs';

    public function product(){
        return $this ->belongsTo('App\Models\Product','product_id');
    }
}
