<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
	protected $table='pesanans'; 
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'tanggal',
        'kode',
        'jumlah_harga',
    ];

    public function user()
	{
	    return $this->belongsTo('App\Models\User','user_id', 'id');
	}

	public function pesanan_detail() 
	{
	    return $this->hasMany('App\PesananDetail','pesanan_id', 'id');
	}

}