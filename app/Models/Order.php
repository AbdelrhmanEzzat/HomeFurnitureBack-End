<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable =[
       'order_id',
       'order_date',
       'total_cost',
       'customer_id',
       'check_out',
       
    ];
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','customer_id');
    }
}
