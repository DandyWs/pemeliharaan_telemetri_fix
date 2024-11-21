<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAlat extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['namajenis', 'setting'];

    protected $searchableFields = ['*'];

    protected $table = 'jenis_alats';

    protected $casts = [
        'setting' => 'boolean',
    ];

    public function alatTelemetris()
    {
        return $this->hasMany(AlatTelemetri::class);
    }
}
