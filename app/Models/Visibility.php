<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    protected $fillable = [
        'class_id',
        'visible_id',
        'visible_model',
        'is_visible'
    ];
    /**
     * Get the parent imageable model (user or post).
     */
    public function visible()
    {
        return $this->morphTo();
    }
}
