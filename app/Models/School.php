<?php

namespace App\Models;

use App\Scopes\SchoolScope;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class School extends Model
{
    use CrudTrait;

    protected $table = 'schools';

    protected static function booted()
    {
        static::addGlobalScope(new SchoolScope);
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }

    public function teachers(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            UserDetails::class,
            'school_id',
            'id',
            null,
            'user_id'
        )->whereHas('roles', function($q){
            $q->where('name', User::ROLE_TEACHER);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'region_id',
    ];
}
