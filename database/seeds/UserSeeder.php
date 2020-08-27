<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'phone_number' => '082142708804',
            'role_id' => '1'
        ]);
    }
}
