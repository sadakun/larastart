<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_penjualan extends Model
{
    use Notifiable;

    protected $fillable = [
        'tgl_penjualan',
        'total',
        'bayar'
    ];

    public function outlet()
    {
        return $this->belongsTo(tbl_outlet::class, 'id_outlet');
    }
    public function detail_penjualan()
    {
        return $this->hasMany(tbl_detail_penjualan::class, 'id_detail_penjualan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    //
}
