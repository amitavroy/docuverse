<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id', 'content', 'weight', 'type'
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
