<?php

namespace App\Models\AuthorModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Soundasleep\Html2Text;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Answer extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;

    protected $fillable = [
        'prefix',
        'answer_content',
        'suffix',
        'question_id',
        'is_correct'
    ];

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $visible = ['id', 'prefix', 'answer_content', 'suffix', 'question_id'];

    public function question()
    {
        return $this->belongsTo('App\Models\AuthorModule\Question');
    }

    public function getTextContentAttribute()
    {
        return mb_substr(Html2Text::convert($this->answer_content, ['ignore_errors' => true, 'drop_links' => true]), 0, 60);
    }

    public function getPrefixContentAttribute()
    {
        return mb_substr(Html2Text::convert($this->prefix, ['ignore_errors' => true, 'drop_links' => true]), 0, 15);
    }

    public function getSuffixContentAttribute()
    {
        return mb_substr(Html2Text::convert($this->suffix, ['ignore_errors' => true, 'drop_links' => true]), 0, 15);
    }
}
