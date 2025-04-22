<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    protected $table = 'base_plants';

    protected $fillable = ['name_latin','name_indonesia'];
    use HasFactory;
}
