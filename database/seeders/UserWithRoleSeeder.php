<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->password = bcrypt('12345678');
        $admin->role = 'admin';
        $admin->save();

        $admin = new User;
        $admin->name = 'Umar';
        $admin->email = 'umar@gmail.com';
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->password = bcrypt('12345678');
        $admin->role = 'pelanggan';
        $admin->save();
    }
}