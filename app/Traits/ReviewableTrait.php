<?php

namespace App\Traits;

use App\Models\Reviewable;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

trait ReviewableTrait {
    protected static function bootReviewableTrait(): void // global scope is not (yet) needed here
    {
        /*
        static::addGlobalScope('reviewable', static function (Builder $query) {
            $user = Auth::user();
            if (!$user || !$user->hasRole(User::ROLE_STUDENT)) {
                return $query;
            }

            $ids = Reviewable::where('reviewable_model', self::class)
                ->where('is_reviewable', true)
                ->pluck('reviewable_id');

            return $query->whereIn('id', $ids);
        });
        */
    }

    public function setReviewable($reviewable, $class){ // setting the reviewable value of item in particular class
        $v = Reviewable::where('class_id', $class)
            ->where('reviewable_model', get_class($this))
            ->where('reviewable_id', $this->id)
            ->first();

        $v->update([
            'is_reviewable' => $reviewable,
        ]);

        return 0;
    }

    public function getReviewable($class)
    {
        $v = Reviewable::where('class_id', $class)
            ->where('reviewable_model', get_class($this))
            ->where('reviewable_id', $this->id)
            ->first();


        return $v->is_reviewable;
    }
}
