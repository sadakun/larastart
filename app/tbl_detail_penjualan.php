<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_detail_penjualan extends Model
{
    use Notifiable;

    protected $fillable = [
        'jumlah_barang', 'sub_total','kembalian'
    ];
    public static function boot()
    {
        parent::boot();
    }

    public function penjualan()
    {
        return $this->belongsTo(tbl_penjualan::class, 'id_penjualan');
    }
    public function produk()
    {
        return $this->belongsTo(tbl_produk::class, 'id_produk');
    }
    public function jenis_barang()
    {
        return $this->belongsTo(tbl_jenisBarang::class, 'id_jenisBarang');
    }
    //
}
