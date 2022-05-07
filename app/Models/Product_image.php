<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $table = 'product_image';
    protected $fillable =[
       'product_image_id',
       'prod_image',
       'prod_id',
      
    ];
    public function product()
    {
       return $this->belongsTo(Product::class,'prod_id','prod_id');
    }	
}
