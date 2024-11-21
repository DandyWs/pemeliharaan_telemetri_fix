<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailKomponen extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['komponen2_id', 'namadetail'];

    protected $searchableFields = ['*'];

    protected $table = 'detail_komponens';

    public function komponen2()
    {
        return $this->belongsTo(Komponen2::class);
    }

    public function formKomponens()
    {
        return $this->hasMany(FormKomponen::class);
    }
}
