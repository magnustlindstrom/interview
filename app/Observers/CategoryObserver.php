<?php

namespace App\Observers;

use App\Models\AuthorModule\Category;

class CategoryObserver
{
    public function created(Category $x)
    {
        $class = $x->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function updating(Category $x)
    {
        $class = $x->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function deleted(Category $x)
    {
        $class = $x->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function restored(Category $x)
    {
        $class = $x->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }

    public function forceDeleted(Category $x)
    {
        $class = $x->section->coursePackage->course->class;
        foreach ($class as $c) {
            $c->syncVisibility();
        }
    }
}
