<?php

namespace App\Http\Controllers;

use App\Services\Category\Actions\ListCategoryAction;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{

    /**
     * @var ListCategoryAction
     */
    private $listCategory;

    public function __construct (ListCategoryAction $listCategory)
    {
        $this->listCategory = $listCategory;
    }
    
    public function index()
    {
        $categories = $this->listCategory->run();
        
        return view('categories.index');
    }
}
