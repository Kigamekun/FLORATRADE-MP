<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = [
        'user_id',
        'plant_id',
        'order_id',
        'comment',
        'rate',
    ];
}
