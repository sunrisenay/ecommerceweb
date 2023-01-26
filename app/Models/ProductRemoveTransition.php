<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRemoveTransition extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'stock_qty', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
