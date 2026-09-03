<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['survey_request_id', 'disk', 'path', 'original_name', 'mime_type', 'size_bytes'])]
class SurveyRequestAttachment extends Model
{
    use HasFactory;

    public function surveyRequest(): BelongsTo { return $this->belongsTo(SurveyRequest::class); }
}
