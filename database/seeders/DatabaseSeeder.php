<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        // User Factory
        $users = User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
        // $role = Role::findByName('pengguna');
        // $role->users()->attach($users);
    }
}
