<?php

namespace Tests\Unit;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResendNotificationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_welcome_notification(): void
    {
        Notification::fake();

        $randomPass = Str::password();
        $user = User::query()->create([
            'name' => fake()->name,
            'lastname' => fake()->lastName,
            'email' => 'mberatsanli@gmail.com',
            'role' => 'user',
            'password' => Hash::make($randomPass),
        ]);
        $user->notify(new WelcomeNotification($randomPass));

        Notification::assertCount(1);
    }

}
