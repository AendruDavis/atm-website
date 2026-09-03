<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[Fillable(['created_by', 'disk', 'path', 'original_name', 'mime_type', 'extension', 'size_bytes', 'width', 'height', 'alt_text', 'caption', 'derivatives', 'is_sample'])]
class MediaAsset extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return ['derivatives' => 'array', 'is_sample' => 'boolean'];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getUrlAttribute(): ?string
    {
        return $this->disk === 'public' ? Storage::disk('public')->url($this->path) : null;
    }
}
