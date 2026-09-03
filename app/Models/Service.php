<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Models\Concerns\Auditable;
use App\Models\Concerns\HasPublication;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['image_media_id', 'title', 'slug', 'eyebrow', 'summary', 'description', 'deliverables', 'applications', 'is_featured', 'sort_order', 'status', 'published_at', 'is_sample', 'seo_title', 'seo_description', 'canonical_url', 'social_media_id', 'seo_index', 'seo_follow'])]
class Service extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['description' => 'array', 'deliverables' => 'array', 'applications' => 'array', 'is_featured' => 'boolean', 'status' => PublicationStatus::class, 'published_at' => 'datetime', 'is_sample' => 'boolean', 'seo_index' => 'boolean', 'seo_follow' => 'boolean'];
    }

    public function image(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'image_media_id'); }
    public function socialImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'social_media_id'); }
    public function projects(): BelongsToMany { return $this->belongsToMany(Project::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
