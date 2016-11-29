<?php

namespace App\Services\Category\Actions;

use App\Services\Category\Tasks\NewCategoryTsk;

class NewCategoryAct
{
    /**
     * @var NewCategoryTsk
     */
    private $newCategoryTsk;

    public function __construct (NewCategoryTsk $newCategoryTsk)
    {
        $this->newCategoryTsk = $newCategoryTsk;
    }
    
    public function run(array $data)
    {
        $data['company_id'] = auth()->user()->company_id;
        $newCategory = $this->newCategoryTsk->run($data);

        return $newCategory->id;
    }
}