<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'summary', 'is_active', 'creator_id', 'published_at',
    ];

    public $timestamps = ['published_at'];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function content(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
