<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $listCompanyId = \App\Models\Company::lists('id')->toArray();
        foreach ($listCompanyId as $companyId) {
            $listCustomerId = \App\Models\Customer::whereCompanyId($companyId)->lists('id')->toArray();
            for ($i = 0; $i < 30; ++$i) {
                \App\Models\Order::create(
                    [
                        'company_id'  => $companyId,
                        'customer_id' => $faker->randomElement($listCustomerId),
                        'datetime'    => $faker->dateTime,
                        'vat'         => $faker->boolean(),
                        'reduction'   => $faker->randomFloat(null, 0, 99),
                        'other_cost'  => $faker->randomFloat(null, 0, 99),
                        'note'        => $faker->text(50),
                    ]
                );
            }
        }
    }
}
