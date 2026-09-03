<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['type', 'title', 'registration_number', 'issuing_body', 'insurance_information', 'is_verified', 'verified_by', 'verified_at', 'sort_order'])]
class Credential extends Model
{
    use Auditable, HasFactory, SoftDeletes;

    protected function casts(): array { return ['is_verified' => 'boolean', 'verified_at' => 'datetime']; }
    public function verifier(): BelongsTo { return $this->belongsTo(User::class, 'verified_by'); }
}
