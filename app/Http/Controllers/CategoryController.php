<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\Actions\DeleteCategoryAct;
use App\Services\Category\Actions\FillDatatableByCompanyAct;
use App\Services\Category\Actions\NewCategoryAct;
use App\Services\Category\Actions\UpdateCategoryAct;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index()
    {
//        $categories = $this->listCategory->run();
        
        return view('categories.index');
    }

    public function fillDatatable(FillDatatableByCompanyAct $datatable)
    {
        return $datatable->run();
    }

    public function destroy($id, DeleteCategoryAct $deleteCategoryAct)
    {
        $deleteCategoryAct->run($id);
    }
    
    public function store(StoreCategoryRequest $request, NewCategoryAct $newCategory)
    {
        if ($request->ajax()) {
            $categoryId = $newCategory->run(['name' => $request->get('data')[1]]);
            return $categoryId;
        }
    }

    public function update(UpdateCategoryRequest $request, $id, UpdateCategoryAct $updateCategoryAct)
    {
        if ($request->ajax()) {
            $updateCategoryAct->run(['name' => $request->get('data')[1]], $id);
        }
    }
}
