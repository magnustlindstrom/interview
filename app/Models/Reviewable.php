<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviewable extends Model
{
    protected $fillable = [
        'class_id',
        'reviewable_id',
        'reviewable_model',
        'is_reviewable'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
}
