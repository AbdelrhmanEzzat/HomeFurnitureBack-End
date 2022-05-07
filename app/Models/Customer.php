<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable =[
       'customer_id',
       'customer_name',
       'birthdate',
       'city',
       'region',
       'street',
       'phone',
       'e_mail',
       'gender',
       'age',
       'password',

    ];

}
