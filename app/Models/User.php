<?php

namespace App\Models;

use App\Models\UserDetails;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CrudTrait, SoftDeletes, HasApiTokens;

    const ROLE_GUEST = 'guest';
    const ROLE_ADMIN = 'admin';
    const ROLE_TEACHER = 'teacher';
    const ROLE_STUDENT = 'student';
    const ROLE_AUTHOR = 'author';

    const ROLES = [
        self::ROLE_GUEST,
        self::ROLE_ADMIN,
        self::ROLE_AUTHOR,
        self::ROLE_STUDENT,
        self::ROLE_TEACHER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['favorite_color'];

    public function getSelectedClassAttribute() //: null|Classes
    {
        if (!$this->hasRole(User::ROLE_STUDENT)) return null;

        $selectedClass = $this->details->selectedClass;
        if (!$selectedClass) {
            $selectedClass = app('student_class')->class;
            $this->details->selectedClass()->associate( $selectedClass );
            $this->details->save();
        }

        return $selectedClass;

    }

    public function details()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'id');
    }

    public function getFavoriteColorAttribute()
    {
        return $this->details->favorite_color ?? '';
    }

    public
    function class_info_private()
    {
        return $this->hasMany(UserClasses::class, 'user_id', 'id')->orderBy('class_id');
    }

    public function class_info()
    {
        if ($this->hasRole(User::ROLE_TEACHER)) {
            $ids = Classes::where('teacher_id', $this->id)->pluck('id');
            return $this->class_info_private()->whereIn('user_classes.class_id', $ids);
        } else {
            return $this->class_info_private();
        }
    }

    public function class()
    {
        return $this->hasMany(Classes::class, 'teacher_id')->whereNull('archived_at');
    }

    public function classThrough()
    {
        return $this->hasManyThrough(
            Classes::class,
            UserClasses::class,
            'user_id',
            'id',
            null,
            'class_id'
        );
    }

    public function region(): HasOneThrough
    {
        // return $this->school->region();

        return $this->hasOneThrough(
            \App\Models\Region::class,
            UserDetails::class,
            'user_id',
            'id',
            null,
            'region_id'
        );
    }

    public function school(): HasOneThrough
    {
        return $this->hasOneThrough(
            School::class,
            UserDetails::class,
            'user_id',
            'id',
            null,
            'school_id'
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->class_info()->delete();
            $user->class_info_private()->delete();
            $user->details()->delete();
        });

        static::restoring(function ($user) {
            UserClasses::withTrashed()->where('user_id', $user->id)->restore();
            UserDetails::withTrashed()->where('user_id', $user->id)->restore();
        });
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
