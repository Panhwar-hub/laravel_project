<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function typeBelongsToCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }   
    
    public function addressBelongsToCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
   
}
