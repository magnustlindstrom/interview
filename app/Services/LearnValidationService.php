<?php

namespace App\Services;

class LearnValidationService
{
    public array $regex = [
        'whole-number' => '^0$|^\-?[1-9][0-9]*?$',
        'decimal-number' => '^\-?[0],\d+$|^\-?([1-9][0-9]*)\,\d+$',
        'fraction' => '^\-?([1-9][0-9]*)[/]([1-9][0-9]*)$',
    ];
}
