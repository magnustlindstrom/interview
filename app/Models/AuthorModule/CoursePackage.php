<?php

namespace App\Models\AuthorModule;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'course_id'
    ];

    protected $with = ['sections'];

    protected $visible = ['id', 'name', 'course_id', 'sections'];

    public function sections()
    {
        return $this->hasMany('App\Models\AuthorModule\Section');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
}
