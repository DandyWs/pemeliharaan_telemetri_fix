<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahModel extends Model
{
    use HasFactory;
    protected $table = 'nasabah';
    protected $fillable = [
        'id_nasabah', 'nama', 'alamat', 'phone', 'foto', 'email', 'password'
    ];

    public function jadwal() {
        return $this->belongsTo(TransaksiBaruModel::class, 'id_nasabah', 'id_nasabah');
    }

    public function user() {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    
}
