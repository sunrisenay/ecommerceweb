<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guard = [];

    public function product(){
        return $this->belongsToMany(product::class);
    }

    public function user(){
        return $this->belongsToMany(user::class);
    }
}
