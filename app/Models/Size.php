<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'size';
	// public $primaryKey = 'id';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function orderHasDetail()
   {     
       return $this->hasOne('App\Models\OrderDetail', 'order_id','id');  
   }

   public function hasManyVariation()
    {
        return $this->hasMany('App\Models\Variation', 'id','color_id');
    }
    public function hasManysizeVariation()
    {
        return $this->hasMany('App\Models\Variation', 'id','size_id');
    }
   
}
