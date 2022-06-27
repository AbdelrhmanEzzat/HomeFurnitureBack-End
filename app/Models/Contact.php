<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';

    protected $fillable =[
       'contact_id',
       'customer_id',
       'designer_id',
       'message',
       'contact_date',

    ];
    public function designer()
    {
       return $this->belongsTo(Designer::class,'designer_id','designer_id');
    }
    public function customer()
    {
       return $this->belongsTo(Customer::class,'customer_id','customer_id');
    }
}
