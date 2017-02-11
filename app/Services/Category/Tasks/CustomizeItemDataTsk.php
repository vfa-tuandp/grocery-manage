<?php
namespace App\Services\Category\Tasks;

class CustomizeItemDataTsk
{
    public function reformatCheckInStockAttribute($data)
    {
        if (empty($data['check_in_stock'])) {
            $data['check_in_stock'] = 0;
        } else {
            $data['check_in_stock'] = 1;
        }
        return $data;
    }

    public function verifyInStockAttribute($data)
    {
//        $data['check_in_stock'] ? : $data['in_stock'] = 0;
        $data['in_stock'] = 0;

        return $data;
    }
}
