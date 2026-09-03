<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasPublication;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['title', 'slug', 'eyebrow', 'summary', 'content', 'status', 'published_at', 'is_sample', 'seo_title', 'seo_description', 'canonical_url', 'social_media_id', 'seo_index', 'seo_follow'])]
class Page extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['content' => 'array', 'status' => PublicationStatus::class, 'published_at' => 'datetime', 'is_sample' => 'boolean', 'seo_index' => 'boolean', 'seo_follow' => 'boolean'];
    }

    public function socialImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'social_media_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
