<?php

namespace App\Models;

use App\Scopes\RegionScope;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use CrudTrait;

    protected $table = 'regions';

    public function schools()
    {
        return $this->hasMany('App\Models\School', 'region_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new RegionScope);
    }
}