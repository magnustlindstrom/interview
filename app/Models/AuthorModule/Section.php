<?php

namespace App\Models\AuthorModule;

use App\Scopes\ContentScope;
use App\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Section extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;
//    use VisibilityTrait;

    protected $fillable = [
        'name',
        'course_package_id',
        'color',
        'is_published',
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $with = ['categories'];

    protected $visible = ['id', 'name', 'course_package_id', 'color', 'categories', 'is_published'];

    public function coursePackage()
    {
        return $this->belongsTo('App\Models\AuthorModule\CoursePackage');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\AuthorModule\Category');
    }

    protected static function booted()
    {
        static::addGlobalScope(new ContentScope);
    }

    public function visible($class_id)
    {
        return $this->morphOne(Visibility::class, 'visible')->where('class_id', $class_id);
    }
}
