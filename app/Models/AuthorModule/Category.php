<?php

namespace App\Models\AuthorModule;

use App\Models\Visibility;
use App\Scopes\ContentScope;
use App\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;
//    use VisibilityTrait;

    protected $fillable = [
        'name',
        'section_id',
        'is_published',
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $with = ['topics'];

    protected $visible = ['id', 'name', 'section_id', 'topics', 'is_published'];

    public function section()
    {
        return $this->belongsTo('App\Models\AuthorModule\Section');
    }

    public function topics()
    {
        return $this->hasMany('App\Models\AuthorModule\Topic');
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
