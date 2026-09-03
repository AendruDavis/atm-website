<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['company_name', 'wordmark', 'tagline', 'company_description', 'phone', 'email', 'whatsapp', 'enquiry_email', 'office_address', 'areas_served', 'latitude', 'longitude', 'social_links', 'trust_facts', 'default_seo_title', 'default_seo_description', 'default_social_media_id'])]
class SiteSetting extends Model
{
    use Auditable, HasFactory;

    protected function casts(): array
    {
        return ['social_links' => 'array', 'trust_facts' => 'array', 'latitude' => 'decimal:7', 'longitude' => 'decimal:7'];
    }

    public function defaultSocialImage(): BelongsTo { return $this->belongsTo(MediaAsset::class, 'default_social_media_id'); }
}
