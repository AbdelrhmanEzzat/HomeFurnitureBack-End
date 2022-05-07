<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable =[
       'post_id',
       'post_title',
       'post_body',
       'published_date',
       'designer_id',

       
    ];
public function designer()
    {
       return $this->belongsTo(Designer::class,'designer_id','designer_id');
    }	    				
}
