<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClasses extends Model
{

    use CrudTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'user_id',
        'grade',
        'created_at',
        'updated_at'
    ];

    protected $with = ['user'];

    public function class()
    {
        return $this->belongsTo('\App\Models\Classes');
    }

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id', 'user_id');
    }
}
