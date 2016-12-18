<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $listCategoryId = \App\Models\Category::lists('id');
        $listCompanyId = \App\Models\Company::lists('id')->toArray();
        foreach ($listCategoryId as $categoryId) {
            for ($i = 0; $i < 4; ++$i) {
                \App\Models\Item::create([
                    'category_id' => $categoryId,
                    'company_id' => $faker->randomElement($listCompanyId),
                    'name' => $faker->word,
                    'unit' => $faker->word,
                    'in_stock' => $faker->randomNumber(2),
                    'price_in_hint' => $faker->randomNumber(2),
                    'price_out_hint' => $faker->randomNumber(2),
                ]);
            }
        }
    }
}
