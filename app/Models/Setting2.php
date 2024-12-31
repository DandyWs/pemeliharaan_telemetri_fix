<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting2 extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['simulasi','pemeliharaan2_id', 'display', 'kondisi'];

    protected $searchableFields = ['*'];

    public function formKomponen()
    {
        return $this->belongsTo(Pemeliharaan2::class);
    }
}
