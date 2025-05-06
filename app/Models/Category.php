<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Process;

class Category extends Model
{
    protected $table = 'base_plants';
    protected $fillable = ['name', 'description', 'thumb'];


}

