<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate_value extends Model
{
    use HasFactory;
    protected $table = 'rate_value';
    protected $fillable =[
       'rate_value_id',
       'rate_value',
      
    ];
}
