<?php

use Ramsey\Uuid\Uuid;

if (!function_exists('generateUuid')) {

    /**
     * Generate string unique
     *
     * @param int $level the uuid level
     *
     * @return string the uuid string
     */
    function generateUuid($level = 4)
    {
        switch ($level) {
            case 1:
                $uuid = Uuid::uuid1();
                break;
            case 3:
                $uuid = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
                break;
            case 5:
                $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
                break;
            default:
                $uuid = Uuid::uuid4();
                break;
        }

        return $uuid->toString();
    }
}

if (!function_exists('formatDate')) {
    /**
     * Format date follow app's rule
     *
     * @param DateTime|\Carbon\Carbon $date Date
     *
     * @return mixed
     */
    function formatDate($date)
    {
        return $date->format(config('define.date_format'));
    }
}

if (!function_exists('parseFromDateTimePicker')) {
    function parseFromDateTimePicker($dateTime)
    {
       return Carbon\Carbon::createFromFormat('d-m-Y H:i', $dateTime);
    }
}
