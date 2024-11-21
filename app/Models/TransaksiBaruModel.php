<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBaruModel extends Model
{
    use HasFactory;
    protected $table = 'transaksibaru';
    protected $primaryKey = 'id_transaksibaru';
    public $incrementing = false;


    protected $fillable =[
        'id_transaksibaru',
        'id_nasabah',
        'id_sopir',
        'tanggal_pengambilan',
        'konfirmasi',
        'jenis_sampah',
        'berat',
        'harga',
    ];


    public function transaksiBaru()
    {
        return $this->belongsTo(TransaksiBaruModel::class, 'id_transaksibaru', 'id');
    }

    public function nasabah()
    {
        return $this->belongsTo(NasabahModel::class, 'id_nasabah', 'id');
    }

    public function sopir()
    {
        return $this->belongsTo(SopirModel::class, 'id_sopir', 'id');
    }

    public function sampah()
    {
        return $this->belongsTo(SampahModel::class, 'jenis_sampah', 'id');
    }  
}