<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    
    use HasFactory;
    public $fillable = ['alias',
                        'title',
                        'price',
                        'description',
                        'category_id',
                        'new_price',
                        'in_stock',
                    ];
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function reviews(){
        return $this->hasMany(ProductReview::class);
    }
    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
}
