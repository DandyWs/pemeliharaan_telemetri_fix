<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komponen2 extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama'];

    protected $searchableFields = ['*'];

    public function detailKomponens()
    {
        return $this->hasMany(DetailKomponen::class);
    }
}
