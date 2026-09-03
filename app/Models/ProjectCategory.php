<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'sort_order'])]
class ProjectCategory extends Model
{
    use Auditable, HasFactory;

    public function projects(): HasMany { return $this->hasMany(Project::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
