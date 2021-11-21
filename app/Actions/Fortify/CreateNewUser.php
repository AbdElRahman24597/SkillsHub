<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'firstname' => ['required', 'string', 'max:255',],
            'lastname' => ['required', 'string', 'max:255',],
            'avatar' => ['nullable', 'image', 'max:2048',],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'password' => Hash::make($input['password']),
        ]);

        if (isset($input['avatar'])) {
            $path = $input['avatar']->store('avatars');
            $user->update([
                'avatar' => $path,
            ]);
        }

        $user->assignRole('student');

        return $user;
    }
}
