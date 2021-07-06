<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id','created_at','updated_at'];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps()->withPivot('count');
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withTimestamps()->withPivot('count');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }

}
