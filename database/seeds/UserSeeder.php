<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'company_id' => 1,
            'name' => 'phuoc',
            'email' => 'phuoc@gmail.com',
            'password' => Hash::make('123456'),
            'level' => 1
        ]);
    }
}
