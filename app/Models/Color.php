<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function productBelongsToColor()
    {
        return $this->belongsTo('App\Models\Products','product_id');
    }   
   
}
