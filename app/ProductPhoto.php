<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['image'];
    public function product()
    {
        return $this->belongTo(Product::class);
    }
}
