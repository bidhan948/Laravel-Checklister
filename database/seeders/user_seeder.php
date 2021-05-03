<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('adminpass'),
            'is_admin'=>1
        ]);
    }
}
