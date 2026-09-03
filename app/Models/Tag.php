<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    use Auditable, HasFactory;

    public function posts(): BelongsToMany { return $this->belongsToMany(Post::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
