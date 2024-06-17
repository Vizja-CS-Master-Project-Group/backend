<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.late_fee', 0.05);
        $this->migrator->add('general.max_days', 30);
    }
};
