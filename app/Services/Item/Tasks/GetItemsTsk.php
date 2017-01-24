<?php

namespace App\Services\Item\Tasks;

use App\Repositories\Item\ItemRepo;

class GetItemsTsk
{
    /**
     * @var ItemRepo
     */
    private $itemRepo;

    public function __construct(ItemRepo $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function getOneById($itemId)
    {
        return $this->itemRepo->find($itemId);
    }

    public function byCategoryId($categoryId, $companyId = null)
    {
        $companyId ?: $companyId = auth()->user()->company_id;

        return $this->itemRepo->findWhere(['category_id' => $categoryId, 'company_id' => $companyId]);
    }
}
