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

#[Fillable(['author_id', 'category_id', 'featured_media_id', 'title', 'slug', 'excerpt', 'content', 'reading_time', 'is_featured', 'is_popular', 'popular_order', 'status', 'published_at', 'is_sample', 'seo_title', 'seo_description', 'canonical_url', 'social_media_id', 'seo_index', 'seo_follow'])]
class Post extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['content' => 'array', 'is_featured' => 'boolean', 'is_popular' => 'boolean', 'status' => PublicationStatus::class, 'published_at' => 'datetime', 'is_sample' => 'boolean', 'seo_index' => 'boolean', 'seo_follow' => 'boolean'];
    }

    public function author(): BelongsTo { return $this->belongsTo(Author::class); }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function featuredImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'featured_media_id'); }
    public function socialImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'social_media_id'); }
    public function tags(): BelongsToMany { return $this->belongsToMany(Tag::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
