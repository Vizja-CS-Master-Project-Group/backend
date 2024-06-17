<?php

namespace App\Settings;

class Settings extends \Spatie\LaravelSettings\Settings
{

    public int $max_days;

    public float $late_fee;

    public static function group(): string
    {
        return 'general';
    }

}
