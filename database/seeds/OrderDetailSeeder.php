<?php

use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $orders = \App\Models\Order::all();
        foreach ($orders as $order) {
            $totalDetail = 0;
            $listItemId = \App\Models\Item::whereCompanyId($order->company_id)->lists('id')->toArray();
            $countItems = random_int(1, 7);
            for ($i = 0; $i < $countItems; ++$i) {
                $quantity = random_int(1, 10);
                $price = $faker->randomFloat(null, 0, 99);
                $reduction = $faker->randomFloat(null, 0, $quantity * $price);
                $otherCost = $faker->randomFloat(null, 0, 99);
                $sum = $price * $quantity + $otherCost - $reduction;
                $totalDetail += $sum;
                \App\Models\OrderDetail::create(
                    [
                        'order_id'           => $order->id,
                        'item_id'            => $faker->randomElement($listItemId),
                        'quantity'           => $quantity,
                        'price'              => $price,
                        'reduction_on_item'  => $reduction,
                        'other_cost_on_item' => $otherCost,
                        'note_on_item'       => $faker->text(50),
                        'sum'                => $sum,
                    ]
                );
            }
            $vatAmount = $order->vat ? ($totalDetail + $order->other_cost) * 0.1 : 0;
            $order->total = $totalDetail + $order->other_cost + $vatAmount - $order->reduction;
            $order->save();
        }
    }
}
