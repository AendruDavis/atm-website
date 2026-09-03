<?php

namespace App\Models;

use App\Enums\EnquiryStatus;
use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'organization', 'email', 'telephone', 'project_type', 'location', 'service_id', 'preferred_survey_date', 'project_description', 'attachment_disk', 'attachment_path', 'attachment_original_name', 'status', 'internal_notes', 'submitted_at'])]
class ContactEnquiry extends Model
{
    use Auditable, HasFactory;

    protected function casts(): array { return ['status' => EnquiryStatus::class, 'preferred_survey_date' => 'date', 'submitted_at' => 'datetime']; }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
}
