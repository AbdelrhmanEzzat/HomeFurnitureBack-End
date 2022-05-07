<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;
    protected $table = 'designer';
    protected $fillable =[
       'designer_id',
       'designer_name',
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
