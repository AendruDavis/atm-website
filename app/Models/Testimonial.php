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

#[Fillable(['photo_media_id', 'client_name', 'organization', 'position', 'testimonial', 'project_type', 'is_featured', 'sort_order', 'status', 'published_at'])]
class Testimonial extends Model
{
    use Auditable, HasFactory, HasPublication, SoftDeletes;

    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'status' => PublicationStatus::class, 'published_at' => 'datetime'];
    }

    public function photo(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'photo_media_id'); }
}
