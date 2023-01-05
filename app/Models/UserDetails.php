<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favorite_color',
        'school_id',
        'region_id',
        'user_id',
    ];

    public function selectedClass()
    {
        return $this->belongsTo(Classes::class, 'selected_class_id', 'id');
    }

    public function school()
    {
        return $this->hasOne('\App\Models\School', 'school_id', 'id');
    }

    public function region()
    {
        return $this->hasOne('\App\Models\Region', 'id', 'region_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
