<?php

namespace App\Services\Category\Tasks;

use App\Repositories\Category\CategoryRepo;

class ListCategoryTsk
{
    /**
     * @var CategoryRepo
     */
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function byCompanyId($companyId = null)
    {
        $companyId ? : $companyId = auth()->user()->company_id;
        return $this->categoryRepo->findByField('company_id', $companyId);
    }
}
