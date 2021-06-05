<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter extends QueryFilter{
    public function search_field($search_string = ''){
            return $this->builder->where('title','LIKE','%'.$search_string.'%');
    }
}