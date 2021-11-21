<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        $data['admins'] = User::role(['moderator', 'admin'])->where('id', '!=', auth()->id())->orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.admins.index')->with($data);
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'role' => 'required|string|in:admin,moderator',
            'password' => $this->passwordRules(),
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars');
            $user->update([
                'avatar' => $avatar,
            ]);
        }

        event(new Registered($user));

        return redirect()->route('dashboard.admins.index')->with('success', 'User added successfully.');
    }

    public function promote(User $user)
    {
        $user->removeRole('moderator')->assignRole('admin');

        return back()->with('success', 'User promoted successfully.');
    }

    public function demote(User $user)
    {
        $user->removeRole('admin')->assignRole('moderator');

        return back()->with('success', 'User demoted successfully.');
    }
}
