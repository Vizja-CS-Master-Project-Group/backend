<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:App\Models\User,email'],
        ]);


        $email = $request->only('email');
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();

        $newPassword = User::randomPassword();
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
        $user->notify(new PasswordResetNotification($newPassword));

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
