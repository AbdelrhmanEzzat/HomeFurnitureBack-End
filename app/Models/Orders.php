<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable =[
        'user_id',
        'total_price',
        'fname',
       'lname',
       'email',
       'phone',
       'address',
       'city',
       'pincode',
       'payment_mode',
       'payment_id',
       'message',
       'tracking_no',
      
    ];
}
