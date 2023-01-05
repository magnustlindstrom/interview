<?php

namespace App\Models\AuthorModule;

use App\Scopes\ContentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Soundasleep\Html2Text;

class Question extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    const QUESTION_FOLLOW_UP = 'Follow Up Questions';
    const QUESTION_EXERCISE = 'Exercise Questions';
    const QUESTION_REVIEW = 'Review Questions';

    public static $questionTypes = [
        1 => self::QUESTION_FOLLOW_UP,
        2 => self::QUESTION_EXERCISE,
        3 => self::QUESTION_REVIEW
    ];

    const ANSWER_TYPE_NUMBER = 'Number';
    const ANSWER_TYPE_MC = 'Multiple Choice';

    public static $answerTypes = [
        1 => self::ANSWER_TYPE_NUMBER,
        2 => self::ANSWER_TYPE_MC,
    ];

    protected $fillable = [
        'question_content',
        'learning_sequence_id',
        'question_type',
        'answer_type',
        'is_published',
        'variable_number_answers',
        'exact_answer',
        'order_of_answers_matter',
        'solution_text'
    ];

    protected $visible = ['id', 'question_content', 'solution_text', 'learning_sequence_id', 'answer_type', 'variable_number_answers', 'exact_answer', 'order_of_answers_matter', 'is_published', 'answers', 'order_column'];

    protected $with = ['answers'];

    public function learningSequence()
    {
        return $this->belongsTo('App\Models\AuthorModule\LearningSequence');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\AuthorModule\Answer');
    }

    public function answersOrdered()
    {
        return $this->hasMany('App\Models\AuthorModule\Answer')->orderByDesc('is_correct');
    }

    public function exercise()
    {
        return $this->belongsTo('App\Models\AuthorModule\Exercise');
    }

    protected static function booted()
    {
        static::addGlobalScope(new ContentScope);
    }

    public function getTextContentAttribute()
    {
        return mb_substr(Html2Text::convert($this->question_content, ['ignore_errors' => true, 'drop_links' => true]), 0, 75);
    }
}
