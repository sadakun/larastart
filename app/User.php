<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Eloquence;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $searchableColumns = [
        'name', 'country', 'city', 'IATA', 'ICAO', 'FAA'
    ];
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'alamat', 'role', 'no_telp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function penjualan()
    {
        return $this->hasMany(tbl_penjualan::class, 'id');
    }
    public function outlet()
    {
        return $this->belongsTo(User::class, 'id_outlet');
    }
}
