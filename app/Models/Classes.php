<?php

namespace App\Models;

use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Exercise;
use App\Models\AuthorModule\LearningSequence;
use App\Models\AuthorModule\Section;
use App\Models\AuthorModule\Topic;
use App\Scopes\ClassScope;
use App\Scopes\ClassTeacherScope;
use App\Traits\VisibilityTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;

class Classes extends Model
{
    use HasFactory, Notifiable, CrudTrait;

    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'course_id',
        'name',
        'end_date',
        'archived_at'
    ];

    protected $appends = ['student_count', 'full_label', 'will_be_deleted_in'];

    protected static function booted()
    {
        static::addGlobalScope(new ClassScope);
    }

    public function book()
    {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }

    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }

    public function coursePackage()
    {
        return $this->course->hasOne(CoursePackage::class);
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }

    public function masterTeacher()
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function students()
    {
        return $this->hasManyThrough(
            User::class,
            UserClasses::class,
            'class_id',
            'id',
            'id',
            'user_id'
        )->orderBy('first_name')->orderBy('last_name');
    }

    public function studentsThroughClasses()
    {
        return $this->hasMany(UserClasses::class, 'class_id')->whereNull('archived_at');
    }

    public function archivedStudentsThroughClasses()
    {
        return $this->hasMany(UserClasses::class, 'class_id')->whereNotNull('archived_at');
    }

    public static function findByName(string $name): Classes
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $class = static::where('name', $name)->first();

        if (!$class) {
            throw RoleDoesNotExist::named($name);
        }

        return $class;
    }

    public function getStudentCountAttribute()
    {
        // $count = $this->students()->count();
        // $archivedCount =
        //     $this->archivedStudents()->count();

        // return $count - $archivedCount;

        return $this->studentsThroughClasses()->count();
    }

    public function archivedStudents()
    {
        return
            $this->studentsThroughClasses()->onlyTrashed()->with(['user' => function ($q) {
                $q->withTrashed();
            }]);
    }

    public function getArchivedStudentCountAttribute()
    {
        return $this->archivedStudents()->count();
    }

    public function getFullLabelAttribute()
    {
        // Class 1 (ma1a) - 24 students, end date: 21.12.2021
        // Class 1 (ma1a) (archived) - 24 students, end date: 21.12.2021

        $part_1 = [
            $this->name,
            "(ma" . $this->course->name . ")",
        ];

        $part_2 = [
            "-",
            $this->getStudentCountAttribute(),
            "students,",
            "end date:",
            $this->end_date
        ];

        if ($this->archived_at) {
            array_push($part_1, "(archived)");
        }

        return implode(" ", array_merge($part_1, $part_2));
    }

    public function scopeActive($query)
    {
        return $query->where('end_date', '>=', Carbon::now()->toDateString());
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at')->where('end_date', '<', Carbon::now()->toDateString());
    }

    public function getWillBeDeletedInAttribute()
    {
        $archived_at = Carbon::parse($this->archived_at);
        $will_be_deleted_at = $archived_at->addMonths(8);
        $today = Carbon::now();
        $date_diff = $will_be_deleted_at->diffInDays($today);

        $date_diff_string = $date_diff . " day";
        if ($date_diff > 1) $date_diff_string .= 's';

        return $date_diff_string;
    }

    public function syncVisibility(){
        $hierarchy = [
            // 'coursePackage' => CoursePackage::class,
            'sections' => Section::class,
            'categories' => Category::class,
            'topics' => Topic::class,
            'learningSequences' => LearningSequence::class,
            'exercises' => Exercise::class,
        ];

        $pointer = $this->coursePackage;

        return $this->recursiveSyncVisibility($pointer, $hierarchy);
    }

    public function recursiveSyncVisibility($pointer, $hierarchy){
        if (count($hierarchy)){
            $relation = array_key_first($hierarchy);
            $model = $hierarchy[$relation];
            unset($hierarchy[$relation]);

            $list = $pointer->$relation()->get();

            foreach ($list as $item){
                Visibility::updateOrCreate(
                    [
                        'class_id' => $this->id,
                        'visible_id' => $item->id,
                        'visible_model' => $model,
                    ],
                    [
                        'class_id' => $this->id,
                        'visible_id' => $item->id,
                        'visible_model' => $model,
                    ]
                );

                $this->recursiveSyncVisibility($item, $hierarchy);
            }
        }

        return 0;
    }

    public function syncReviewable(){
        $hierarchy = [
            // 'coursePackage' => CoursePackage::class,
            'sections' => Section::class,
            'categories' => Category::class,
            'topics' => Topic::class,
            'learningSequences' => LearningSequence::class,
            'exercises' => Exercise::class,
        ];

        $pointer = $this->coursePackage;

        return $this->recursiveSyncReviewable($pointer, $hierarchy);
    }

    public function recursiveSyncReviewable($pointer, $hierarchy){
        if (count($hierarchy)){
            $relation = array_key_first($hierarchy);
            $model = $hierarchy[$relation];
            unset($hierarchy[$relation]);

            $list = $pointer->$relation()->get();

            foreach ($list as $item){
                Reviewable::updateOrCreate(
                    [
                        'class_id' => $this->id,
                        'reviewable_id' => $item->id,
                        'reviewable_model' => $model,
                    ],
                    [
                        'class_id' => $this->id,
                        'reviewable_id' => $item->id,
                        'reviewable_model' => $model,
                    ]
                );

                $this->recursiveSyncReviewable($item, $hierarchy);
            }
        }

        return 0;
    }

}
