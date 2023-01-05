<?php

namespace App\Observers;

use App\Models\AuthorModule\Topic;

class TopicObserver
{
    public function created(Topic $x)
    {
        $class = $x->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function updating(Topic $x)
    {
        $class = $x->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function deleted(Topic $x)
    {
        $class = $x->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function restored(Topic $x)
    {
        $class = $x->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function forceDeleted(Topic $x)
    {
        $class = $x->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }
}
