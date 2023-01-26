<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','user_id','rating','review'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}



