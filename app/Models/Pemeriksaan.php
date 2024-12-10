<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Creagia\LaravelSignPad\Concerns\RequiresSignature;
use Creagia\LaravelSignPad\Contracts\CanBeSigned;
use Creagia\LaravelSignPad\Contracts\ShouldGenerateSignatureDocument;
use Creagia\LaravelSignPad\Templates\BladeDocumentTemplate;
use Creagia\LaravelSignPad\Templates\PdfDocumentTemplate;
use Creagia\LaravelSignPad\SignatureDocumentTemplate;
use Creagia\LaravelSignPad\SignaturePosition;

class Pemeriksaan extends Model implements CanBeSigned
{
    use RequiresSignature;
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
