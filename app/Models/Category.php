<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'category_name', 'category_desc', 'category_status','category_ava'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_categories';
    public function products(){
        return $this ->hasMany('App\Models\Product','category_id');
    }
}
