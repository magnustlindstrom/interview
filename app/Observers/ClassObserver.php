<?php

namespace App\Observers;

use App\Models\Classes;
use Carbon\Carbon;

class ClassObserver
{
    /**
     * Handle the Classes "created" event.
     *
     * @param Classes $class
     * @return void
     */
    public function created(Classes $class)
    {
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    /**
     * Handle the Classes "updating" event.
     *
     * @param Classes $class
     * @return void
     */
    public function updating(Classes $class)
    {
        if ($class->isDirty('end_date')) {
            if ($class->end_date >= Carbon::now()->toDateString()) {
                $class->archived_at = null;
            } else {
                if ($class->archived_at == null) {
                    $class->archived_at = Carbon::now();
                }
            }
        }
    }

    /**
     * Handle the Classes "deleted" event.
     *
     * @param Classes $class
     * @return void
     */
    public function deleted(Classes $class)
    {
        //
    }

    /**
     * Handle the Classes "restored" event.
     *
     * @param Classes $class
     * @return void
     */
    public function restored(Classes $class)
    {
        //
    }

    /**
     * Handle the Classes "force deleted" event.
     *
     * @param Classes $class
     * @return void
     */
    public function forceDeleted(Classes $class)
    {
        //
    }
}
