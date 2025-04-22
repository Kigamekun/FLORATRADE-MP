<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','kode_transaksi','tax', 'total_price','date','total_price_after_disc', 'status', 'currency','discount','discount_code', 'hasPaid', 'nama_penerima', 'alamat_penerima', 'email_penerima', 'negara_tujuan','provinsi_tujuan','kota_tujuan','zipcode','shipping_method','shipping_price'];
    use HasFactory;
}
