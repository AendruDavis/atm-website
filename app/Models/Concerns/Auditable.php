<?php

namespace App\Models\Concerns;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait Auditable
{
    public static function bootAuditable(): void
    {
        foreach (['created', 'updated', 'deleted', 'restored'] as $event) {
            static::$event(function (Model $model) use ($event): void {
                if (! Auth::check() || ! Schema::hasTable('audit_logs')) {
                    return;
                }

                AuditLog::query()->create([
                    'user_id' => Auth::id(),
                    'event' => $event,
                    'auditable_type' => $model->getMorphClass(),
                    'auditable_id' => $model->getKey(),
                    'old_values' => $event === 'updated' ? $model->getOriginal() : null,
                    'new_values' => in_array($event, ['created', 'updated'], true) ? $model->getAttributes() : null,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
            });
        }
    }
}
