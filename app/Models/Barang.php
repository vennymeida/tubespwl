<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Barang as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table='barangs';
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
        'Merk',
        'Harga',
        'Stok',
        'Keterangan',
        'featured_image',
        ];
}
