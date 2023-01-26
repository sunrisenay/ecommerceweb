<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','supplier_id','name','image','description','stock_qty','sale_price','discounted_price'];

    public function getImageUrlAttribute()
    {
        return asset('/assets/img/'. $this -> image);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productaddTransition(){
        return $this->hasMany(ProductAddTransition::class);
    }

    public function productremoveTransition(){
        return $this->hasMany(ProductRemoveTransition::class);
    }

    public function review(){
        return $this->hasMany(ProductReview::class);
    }

    public function cart(){
        return $this->hasMany(cart::class);
    }

    public function order(){
        return $this->hasMany(order::class);
    }
}
