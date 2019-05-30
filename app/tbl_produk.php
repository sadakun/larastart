<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_produk extends Model
{
    use Notifiable;

    protected $fillable = [
        'id_jenisBarang',
        'nama_produk',
        'harga_produk',
        'gambar_produk',
       
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function detail_penjualan()
    {
        return $this->belongsTo(tbl_detail_penjualan::class, 'id_detail_penjualan');
    }
    public function jenis_barang()
    {
        return $this->hasMany(tbl_jenisBarang::class, 'id_jenisBarang');
    }

    //
}
