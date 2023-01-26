<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =['slug', 'name', 'image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/assets/img/'. $this -> image);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'product_category');
    }
}
