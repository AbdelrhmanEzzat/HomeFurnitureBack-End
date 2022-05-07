<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consist_of extends Model
{
    use HasFactory;
    protected $table = 'consist_of';
    protected $fillable =[
       'consist_of_id',
       'order_id',
       'prod_id',
       'status',
       'no_of_product',
      
    ];
    public function order()
    {
       return $this->belongsTo(Order::class,'order_id','order_id');
    }	
    public function product()
    {
       return $this->belongsTo(Product::class,'prod_id','prod_id');
    }	
    
}
