<?php

namespace App\Observers;

use App\Models\AuthorModule\Exercise;

class ExerciseObserver
{
    public function created(Exercise $x)
    {
        $class = $x->learningSequence->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
            $c->syncReviewable();
        }
    }

    public function updating(Exercise $x)
    {
        $class = $x->learningSequence->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
            $c->syncReviewable();
        }
    }

    public function deleted(Exercise $x)
    {
        $class = $x->learningSequence->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
            $c->syncReviewable();
        }
    }

    public function restored(Exercise $x)
    {
        $class = $x->learningSequence->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
            $c->syncReviewable();
        }
    }

    public function forceDeleted(Exercise $x)
    {
        $class = $x->learningSequence->topic->category->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
            $c->syncReviewable();
        }
    }
}
