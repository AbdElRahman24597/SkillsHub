<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $moderatorRole = Role::create([
            'name' => 'moderator',
        ]);

        $studentRole = Role::create([
            'name' => 'student',
        ]);


        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@localhost',
            'firstname' => 'iam',
            'lastname' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt(123456789),
        ]);
        $admin->assignRole($adminRole);

        $moderator = User::create([
            'username' => 'moderator',
            'email' => 'moderator@localhost',
            'firstname' => 'iam',
            'lastname' => 'moderator',
            'email_verified_at' => now(),
            'password' => bcrypt(123456789),
        ]);
        $moderator->assignRole($moderatorRole);

        $student = User::create([
            'username' => 'student',
            'email' => 'student@localhost',
            'firstname' => 'iam',
            'lastname' => 'student',
            'email_verified_at' => now(),
            'password' => bcrypt(123456789),
        ]);
        $student->assignRole($studentRole);
    }
}
