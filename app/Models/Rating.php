<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $fillable =[
       'rate_id',
       'product_quality',
       'service_quality',
       'rate_value_id',
       'rating_name',
       'customer_id',

    ];
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','customer_id');
    }
    public function rate_value()
    {
       return $this->belongsTo(Rate_value::class,'rate_value_id','rate_value_id');
    }
    
}
