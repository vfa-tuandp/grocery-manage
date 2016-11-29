<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $listCompanyId = \App\Models\Company::lists('id');
        foreach ($listCompanyId as $companyId) {
            for ($i = 1; $i < 15; ++$i) {
                \App\Models\Category::create([
                    'name' => $faker->sentence,
                    'company_id' => $companyId
                ]);
            }
        }
    }
}
