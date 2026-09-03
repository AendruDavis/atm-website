<?php

namespace App\Models\Concerns;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

trait HasPublication
{
    #[Scope]
    protected function published(Builder $query): void
    {
        $query
            ->where('status', PublicationStatus::Published)
            ->where(function (Builder $query): void {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }

    #[Scope]
    protected function scheduledForPublishing(Builder $query): void
    {
        $query
            ->where('status', PublicationStatus::Scheduled)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
