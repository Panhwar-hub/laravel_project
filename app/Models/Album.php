<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{    
	protected $table = 'album';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    public function albumHasPhotos()
    {
    return $this->hasMany(Photos::class,'album_id','id');
    }
    
    

}
