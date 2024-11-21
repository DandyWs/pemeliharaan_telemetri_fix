<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable =[
        'id_jadwal',
        'jenis_sampah',
        'berat',
        'harga',
    ];

    public function transaksi(){
        return $this->belongsTo(TransaksiModel::class);
    }

    public function jadwal(){
        return $this->belongsTo(JadwalModel::class, 'id_jadwal', 'id');
    }

    public function sampah(){
        return $this->belongsTo(SampahModel::class, 'jenis_sampah', 'id');
    }
}
