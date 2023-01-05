<?php

namespace App\Traits;

use Auth;
use App\Models\User;
use App\Models\Visibility;
use Illuminate\Database\Eloquent\Builder;

trait VisibilityTrait {
    protected static function bootVisibilityTrait()
    {

        static::addGlobalScope('visible', function (Builder $query) {
            $user = Auth::user();
            if(!$user || !$user->hasRole( User::ROLE_STUDENT) ) return $query;

            $ids = Visibility::where('visible_model', self::class)
                ->where('is_visible', true)
                ->pluck('visible_id');

            return $query->whereIn('id', $ids);
        });
    }

    public function setVisibility($visibility, $class){ // setting the visibility of item in particular class
        $v = Visibility::where('class_id', $class)
            ->where('visible_model', get_class($this))
            ->where('visible_id', $this->id)
            ->first();

        $v->update([
            'is_visible' => $visibility,
        ]);
        return 0;
    }

    public function getVisibility($class)
    {
        $v = Visibility::where('class_id', $class)
            ->where('visible_model', get_class($this))
            ->where('visible_id', $this->id)
            ->first();


        return $v->is_visible;
    }
}
