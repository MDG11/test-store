<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewImage extends Model
{
    use HasFactory;


    protected $table = 'product_review_images';

    public function product_review(){
        return $this->belongsTo(ProductReview::class);
    }
}
