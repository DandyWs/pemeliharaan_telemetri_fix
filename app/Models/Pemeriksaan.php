<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeriksaan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ttd', 'catatan', 'pemeliharaan2_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function pemeliharaan2()
    {
        return $this->belongsTo(Pemeliharaan2::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
