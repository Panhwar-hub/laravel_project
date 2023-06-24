<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function typeBelongsToCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }   
   
}
