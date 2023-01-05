<?php

namespace App\Observers;

use App\Models\AuthorModule\CoursePackage;

class CoursePackageObserver
{
    public function created(CoursePackage $x)
    {
        $class = $x->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function updating(CoursePackage $x)
    {
        $class = $x->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function deleted(CoursePackage $x)
    {
        $class = $x->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function restored(CoursePackage $x)
    {
        $class = $x->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function forceDeleted(CoursePackage $x)
    {
        $class = $x->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }
}
