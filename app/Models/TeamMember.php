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

#[Fillable(['photo_media_id', 'name', 'slug', 'job_title', 'qualifications', 'areas_of_expertise', 'biography', 'professional_memberships', 'linkedin_url', 'is_featured', 'sort_order', 'status', 'published_at', 'is_sample'])]
class TeamMember extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['qualifications' => 'array', 'areas_of_expertise' => 'array', 'professional_memberships' => 'array', 'is_featured' => 'boolean', 'status' => PublicationStatus::class, 'published_at' => 'datetime', 'is_sample' => 'boolean'];
    }

    public function photo(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'photo_media_id'); }
    public function getRouteKeyName(): string { return 'slug'; }
}
