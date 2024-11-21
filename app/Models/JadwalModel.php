<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalModel extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable =[
        'id_jadwal',
        'id_nasabah',
        'id_sopir',
        'tanggal_pengambilan',
        'konfirmasi'
    ];

    public function jadwal(){
        return $this->belongsTo(JadwalModel::class);
    }

    public function nasabah(){
        return $this->belongsTo(NasabahModel::class, 'id_nasabah', 'id');
    }

    public function sopir(){
        return $this->belongsTo(SopirModel::class, 'id_sopir', 'id');
    }

    public function transaksi(){
        return $this->hasMany(TransaksiModel::class);
    }
}
