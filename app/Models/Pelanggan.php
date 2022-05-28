<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Pelanggan as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table='pelanggan';
    protected $primaryKey = 'id_pelanggan'; // Memanggil isi DB Dengan primarykey
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
        'Nik',
        'Nama',
        'Alamat',
        'Telepon',
        ];
}
