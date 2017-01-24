<?php

namespace App\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class MyBaseRepository extends BaseRepository
{
    /**
     * Get query builder for datatables
     *
     * @param array $column query column
     *
     * @return Illuminate\Database\Eloquent\Builder         QueryBuilder for datatable
     */
    public function makeQueryBuilder($select = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        return $this->model->select($select);
    }

    public function insertMany(array $data, $timestamp = true, $append = null)
    {
        if ($timestamp) {
            foreach ($data as $key => $value) {
                $value['updated_at'] = Carbon::now();
                $value['created_at'] = Carbon::now();
                $data[$key] = $value;
            }
        }
        
        if ($append && is_array($append)) {
            foreach ($data as $key => $value) {
                $value = array_merge($value, $append);
                $data[$key] = $value;
            }
        }
        return \DB::table($this->model->getTable())->insert($data);
    }
}
