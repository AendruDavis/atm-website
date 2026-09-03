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

#[Fillable(['project_category_id', 'featured_media_id', 'download_media_id', 'title', 'slug', 'location', 'project_type', 'client_sector', 'overview', 'services_provided', 'outcomes', 'project_date', 'is_featured', 'sort_order', 'status', 'published_at', 'is_sample', 'seo_title', 'seo_description', 'canonical_url', 'social_media_id', 'seo_index', 'seo_follow'])]
class Project extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['services_provided' => 'array', 'outcomes' => 'array', 'project_date' => 'date', 'is_featured' => 'boolean', 'status' => PublicationStatus::class, 'published_at' => 'datetime', 'is_sample' => 'boolean', 'seo_index' => 'boolean', 'seo_follow' => 'boolean'];
    }

    public function category(): BelongsTo { return $this->belongsTo(ProjectCategory::class, 'project_category_id'); }
    public function featuredImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'featured_media_id'); }
    public function download(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'download_media_id'); }
    public function socialImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'social_media_id'); }
    public function services(): BelongsToMany { return $this->belongsToMany(Service::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
