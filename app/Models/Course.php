<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{

    use HasFactory, Notifiable, CrudTrait;

    //
    protected $table = 'courses';

    public function books() {
        return $this->hasMany('App\Models\Book', 'book_id', 'id');
    }

    public function coursePackage()
    {
        return $this->hasOne('App\Models\AuthorModule\CoursePackage');
    }

    public function class()
    {
        return $this->hasMany('App\Models\Classes', 'course_id', 'id');
    }

}
