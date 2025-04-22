<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $table = 'plants';
    protected $fillable = ['name','status','wholesale_price','stock','price','thumb','category_id','description'];
    use HasFactory;
}
