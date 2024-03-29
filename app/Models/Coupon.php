<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public $fillable = ['code',
    'type',
    'expiry_date',
    'value',
    'cart_value',];
}
