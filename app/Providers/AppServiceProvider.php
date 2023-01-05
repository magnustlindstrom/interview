<?php

namespace App\Providers;

use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Exercise;
use App\Models\AuthorModule\LearningSequence;
use App\Models\AuthorModule\Section;
use App\Models\AuthorModule\Topic;
use App\Models\User;
use App\Models\Classes;
use App\Observers\CategoryObserver;
use App\Observers\ClassObserver;
use App\Observers\CoursePackageObserver;
use App\Observers\ExerciseObserver;
use App\Observers\LearningSequenceObserver;
use App\Observers\SectionObserver;
use App\Observers\TopicObserver;
use App\Custom\Blade\SvgDirective;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Classes::observe(ClassObserver::class); // added
        CoursePackage::observe(CoursePackageObserver::class); // added
        Section::observe(SectionObserver::class); // added
        Category::observe(CategoryObserver::class); // added
        Topic::observe(TopicObserver::class); // added
        LearningSequence::observe(LearningSequenceObserver::class); // added
        Exercise::observe(ExerciseObserver::class);
        SvgDirective::add();

        $this->app->bind('student_class', function(){
            $user =  auth()->user();
            if( $user->hasRole(User::ROLE_STUDENT) )
            {
                $classes = $user->class_info()->with('class.course.coursePackage');
                if( $classId = $user->details->selected_class_id )
                {
                    $classes = $classes->where('class_id', $classId);
                }
                return $classes->first();
            }
        });
    }
}
