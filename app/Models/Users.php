<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_name', 'user_email', 'user_password','user_phone','user_ava'
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_user';
}
