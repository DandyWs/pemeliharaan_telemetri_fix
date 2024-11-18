<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopirModel extends Model
{
    use HasFactory;
    protected $table = 'sopir';
    protected $fillable = [
        'id_sopir', 'nama', 'alamat', 'phone', 'sopir', 'email', 'password'
    ];

    public function jadwal(){
        return $this->hasMany(TransaksiBaruModel::class);
    }
}
