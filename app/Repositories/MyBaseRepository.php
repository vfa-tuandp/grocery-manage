<?php

namespace App\Repositories;

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

}