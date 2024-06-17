<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Settings\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return [
            'late_fee' => app(Settings::class)->late_fee,
            'max_days' => app(Settings::class)->max_days,
        ];
    }

    public function update(Settings $settings, UpdateSettingsRequest $request)
    {
        $settings->late_fee = $request->validated('late_fee');
        $settings->max_days = $request->validated('max_days');
        $settings->save();

        return $this->index();
    }

}
