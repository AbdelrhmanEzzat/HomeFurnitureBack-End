<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProduct extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable =[
       'id',
       'product_name',
       'cost',
       'details',
       'extradetails',
       'material',
       'rate_id',
       'category_id',
];
public function category()
{
   return $this->belongsTo(Order::class,'category_id','category_id');
}
public function rating()
{
   return $this->belongsTo(Rating::class,'rate_id','rate_id');
}
}

