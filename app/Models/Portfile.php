<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfile extends Model
{
    use HasFactory;
    protected $table = 'portfile';
    protected $primaryKey = 'port_id';

    protected $fillable =[
       'port_id',
       'port_title',
       'port_body',
       'published_date',
       'designer_id',

    ];
    public function designer()
    {
       return $this->belongsTo(Designer::class,'designer_id','designer_id');
    }
}
