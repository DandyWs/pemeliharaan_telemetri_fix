<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormKomponen extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['pemeliharaan2_id', 'detail_komponen_id', 'cheked'];

    protected $searchableFields = ['*'];

    protected $table = 'form_komponens';

    protected $casts = [
        'cheked' => 'boolean',
    ];

    public function pemeliharaan2()
    {
        return $this->belongsTo(Pemeliharaan2::class);
    }

    public function detailKomponen()
    {
        return $this->belongsTo(DetailKomponen::class);
    }

    public function setting2s()
    {
        return $this->hasMany(Setting2::class);
    }
}
