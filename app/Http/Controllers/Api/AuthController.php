<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use PasswordValidationRules;

    public function register(): JsonResponse
    {
        $attributes = validator(request()->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'avatar' => 'image|max:2048',
            'password' => $this->passwordRules(),
        ])->validate();

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        if (request()->hasFile('avatar')) {
            $user->update([
                'avatar' => $attributes['avatar']->store('avatars'),
            ]);
        }

        $user->assignRole('student');
        $user->unsetRelation('roles');

        // event(new Registered($user)); //TODO:Need to fix.
        $user->update([
            'email_verified_at' => now(), // Remove this after fixing Registered event.
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => UserResource::make($user),
                'token' => $token,
            ],
        ], Response::HTTP_CREATED);
    }

    public function login(): JsonResponse
    {
        $attributes = validator(request()->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ])->validate();

        $user = User::where('email', $attributes['username'])->orWhere('username', $attributes['username'])->first();

        if ($user && Hash::check($attributes['password'], $user->password)) {
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'data' => [
                    'user' => UserResource::make($user),
                    'token' => $token,
                ],
            ]);
        }

        return response()->json(['message' => __('auth.failed')], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
