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
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'status' => 1,
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Teknik Komputer',
            'email' => 'tekkom@mail.com',
            'role_id' => 2,
            'status' => 1,
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('user');
    }
}
