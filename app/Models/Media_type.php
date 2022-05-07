<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_type extends Model
{
    use HasFactory;
    protected $table = 'media_type';
    protected $fillable =[
       'media_type_id',
       'media_type',
       
       
    ];

}
