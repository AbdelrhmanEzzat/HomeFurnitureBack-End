<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $table = 'media';
    protected $fillable =[
       'media_id',
       'post_id',
       'port_id',
       'media_type_id',
       
    ];
    public function post()
    {
       return $this->belongsTo(Post::class,'post_id','post_id');
    }
    
    public function media_type()
    {
       return $this->belongsTo(Media_type::class,'media_type_id','media_type_id');
    }
    public function portfile()
    {
       return $this->belongsTo(Portfile::class,'port_id','port_id');
    }


}
