<?php

namespace App\Listeners;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $object = $event->object;

        Activity::create([
            'description' => class_basename(get_class($object)) . ' ' . ($object->id ?? 'unknown') . ' has been ' . $event->description,
            'subject_id' => $object->id ?? null,
            'subject_type' => get_class($object),
            'user_id' => auth('web')->id() ?? null,
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ]);
    }
}
