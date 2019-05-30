<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class tbl_outlet extends Model
{
    use Notifiable;

    protected $fillable = [
        'nama_outlet',
        'alamat_outlet',
        'telp_outlet',

    ];
    public static function boot()
    {
        parent::boot();
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id_user');
    }

    public function penjualan()
    {
        return $this->hasMany(User::class, 'id_penjualan');
    }

    //
}
