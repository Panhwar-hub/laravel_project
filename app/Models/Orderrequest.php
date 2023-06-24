<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderrequest extends Model
{
    use HasFactory;
    protected $table = 'orderrequest';
	// public $primaryKey = 'id';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

}
