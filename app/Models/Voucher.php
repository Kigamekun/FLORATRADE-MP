<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $fillable = ['code','disc'];
    use HasFactory;
}
