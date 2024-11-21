<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlatTelemetri extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['lokasiStasiun', 'jenis_alat_id'];

    protected $searchableFields = ['*'];

    protected $table = 'alat_telemetris';

    public function jenisAlat()
    {
        return $this->belongsTo(JenisAlat::class);
    }

    public function pemeliharaan2s()
    {
        return $this->hasMany(Pemeliharaan2::class);
    }
}
