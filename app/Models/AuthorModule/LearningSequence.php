<?php

namespace App\Models\AuthorModule;

use App\Scopes\ContentScope;
use App\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class LearningSequence extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;
    use VisibilityTrait;

    protected $fillable = [
        'title',
        'topic_id',
        'theory_content',
        'theory_video',
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $visible = ['id', 'title', 'topic_id', 'theory_content', 'theory_video', 'follow_up_questions', 'exercises', 'description'];
    protected $with = ['follow_up_questions', 'exercises'];

    public function topic()
    {
        return $this->belongsTo('App\Models\AuthorModule\Topic');
    }

    public function follow_up_questions()
    {
        return $this->hasMany('App\Models\AuthorModule\Question');
    }

    public function exercises()
    {
        return $this->hasMany('App\Models\AuthorModule\Exercise')
            ->orderBy('order_column');
    }

    public function visible($class_id)
    {
        return $this->morphOne(Visibility::class, 'visible')->where('class_id', $class_id);
    }
}
