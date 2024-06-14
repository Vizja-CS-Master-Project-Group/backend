<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            QueryBuilder::for(User::class)
                ->allowedSorts(['id', 'name', 'lastname', 'email'])
                ->defaultSort('-id')
                ->paginate()
                ->setPath('')
        );
    }

    public function create()
    {
        return $this->schema();
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $randomPass = User::randomPassword();

        /** @var User $user */
        $user = User::query()->create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($randomPass),
        ]);
        $user->notify(new WelcomeNotification($randomPass));

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return $this->schema();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return [
            'data' => [
                'message' => 'User deleted successfully',
            ]
        ];
    }

    protected function schema() {
        return [
            'roles' => [
                'admin',
                'librarian',
                'user'
            ],
        ];
    }
}
