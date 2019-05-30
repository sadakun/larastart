<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_jenisBarang extends Model
{
    use Notifiable;

    protected $fillable = [
        'jenisBarang'
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function detail_penjualan()
    {
        return $this->hasMany(tbl_detail_penjualan::class, 'id_detail_penjualan');
    }
    public function produk()
    {
        return $this->hasMany(tbl_produk::class, 'id_produk');
    }

    //
}
