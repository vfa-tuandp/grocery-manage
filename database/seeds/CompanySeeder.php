<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::create([
            'name' => 'Thành Đạt'
        ]);
        \App\Models\Company::create([
            'name' => 'Mến Mỹ'
        ]);
    }
}
