<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampahModel extends Model
{
    use HasFactory;
    protected $table = 'sampah';
    protected $fillable = [
        'jenis_sampah',
        'harga',
        'foto',
    ];

    public function transaksibaru(){
        return $this->hasMany(TransaksiBaruModel::class);
    }
}
