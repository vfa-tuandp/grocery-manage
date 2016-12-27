<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
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
        for ($i = 0; $i < 40; ++$i) {
            \App\Models\Customer::create(
                [
                    'company_id' => $faker->randomElement($listCompanyId),
                    'name'       => $faker->name,
                    'company'    => $faker->company,
                    'email'      => $faker->companyEmail,
                    'phone'      => $faker->phoneNumber,
                    'address'    => $faker->address,
                ]
            );
        }
    }
}
