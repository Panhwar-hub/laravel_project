<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function featureBelongsToCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }   
   
}
