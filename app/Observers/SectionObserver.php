<?php

namespace App\Observers;

use App\Models\AuthorModule\Section;

class SectionObserver
{
    public function created(Section $x)
    {
        $class = $x->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function updating(Section $x)
    {
        $class = $x->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function deleted(Section $x)
    {
        $class = $x->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function restored(Section $x)
    {
        $class = $x->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function forceDeleted(Section $x)
    {
        $class = $x->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }
}
