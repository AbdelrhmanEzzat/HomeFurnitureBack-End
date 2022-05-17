<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable =[
       'prod_id',
       'product_name',
       'cost',
       'details',
       'material',
       'rate_id',
       'category_id',
       'slug',
       'small_description',
       'description',
       'original_price',
       'selling_price',
       'image',//
       'qty',
       'tax',
       'status',
       'trending',
       'meta_title',
       'meta_keywords',
       'meta_descrip',


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
