<?php

namespace App\Observers;

use App\Models\AuthorModule\LearningSequence;
use Illuminate\Support\Str;

class LearningSequenceObserver
{
    public function created(LearningSequence $x)
    {
        $class = $x->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function updating(LearningSequence $x)
    {
        $class = $x->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function deleted(LearningSequence $x)
    {
        $class = $x->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function restored(LearningSequence $x)
    {
        $class = $x->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function forceDeleted(LearningSequence $x)
    {
        $class = $x->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }
}
