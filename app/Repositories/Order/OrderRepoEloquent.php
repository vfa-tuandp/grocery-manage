<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\MyBaseRepository;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderRepoEloquent extends MyBaseRepository implements OrderRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    public function getOrderQuery($companyId)
    {
        return \DB::table('orders')
            ->leftJoin('customers', function ($join) {
                $join->on('orders.customer_id', '=', 'customers.id');
            })->leftJoin('order_details', function ($join) {
                $join->on('orders.id', '=', 'order_details.order_id');
            })->join('items', function ($join) {
                $join->on('items.id', '=', 'order_details.item_id');
            })->join('categories', function ($join) {
                $join->on('items.category_id', '=', 'categories.id');
            })->where('orders.company_id', '=', $companyId)
            ->select([
                'datetime',
                'categories.name as category_name',
                'items.name as item_name',
                'items.unit as unit',
                'order_details.quantity',
                'customers.name as target_name',
                \DB::raw("'Bán' as kind"),
                'orders.id as detail_id'
            ]);
    }
}
