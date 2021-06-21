<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonal extends Model
{
    use HasFactory;
    public $fillable = ['firstname', 'lastname', 'mobile', 'email', 'adress_line_1', 'adress_line_2', 'province', 'country', 'zipcode'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
