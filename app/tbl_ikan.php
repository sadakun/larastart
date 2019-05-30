<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_ikan extends Model
{
    use Notifiable;

    protected $fillable = [
        'nama_ikan',
        'harga_ikan',
        'jumlah_ikan'
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function detail_penjualan()
    {
        return $this->hasMany(tbl_detail_penjualan::class, 'id_penjualan');
    }
    //
}
