<?php

namespace App\Models\AuthorModule;

use App\Scopes\ContentScope;
use App\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Topic extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;
    use VisibilityTrait;

    protected $fillable = [
        'name',
        'category_id',
        'is_published',
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $visible = ['id', 'name', 'category_id', 'questions', 'is_published', 'learningSequences'];

    protected $with = ['learningSequences'];

    public function category()
    {
        return $this->belongsTo('App\Models\AuthorModule\Category');
    }

    public function learningSequences()
    {
        return $this->hasMany('App\Models\AuthorModule\LearningSequence');
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
