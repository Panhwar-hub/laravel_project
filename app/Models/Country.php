<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{    
	protected $table = 'fb_country';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    

}
