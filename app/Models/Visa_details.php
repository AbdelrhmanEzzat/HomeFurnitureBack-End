<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa_details extends Model
{
    use HasFactory;
    protected $table = 'visa_details';
    protected $fillable =[
       'Cvv',
       'visa_type',
       'month',
       'year',
       'customer_id',
       'visa_no',

    ];
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','customer_id');
    }
}
