<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['photo_media_id', 'name', 'slug', 'job_title', 'biography', 'linkedin_url'])]
class Author extends Model
{
    use Auditable, HasFactory;

    public function photo(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'photo_media_id'); }
    public function posts(): HasMany { return $this->hasMany(Post::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
