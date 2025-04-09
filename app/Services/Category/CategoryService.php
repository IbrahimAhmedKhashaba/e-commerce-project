<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        //
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoriesForDataTables(){
        $categories = $this->categoryRepository->getAllCategories();
        return DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('name' , function($category){
            return $category->getTranslation('name' , Config('app.locale'));
        })
        ->addColumn('actions' , function($category){
            return view('dashboard.categories.actions' , compact('category'));
        })
        ->make(true);
    }

    public function getAllCategories(){
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategory($id){
        return $this->categoryRepository->getCategory($id);
    }

    public function getCategoryWithChildrenCount($id){
        return $this->categoryRepository->getCategoryWithChildrenCount($id);
    }

    public function store($request){
        return $this->categoryRepository->store($request);
    }

    public function update($request  ,$id){
        $category = $this->getCategory($id);
        return $this->categoryRepository->update($category , $request);
    }

    public function destroy($id){
        $category = $this->getCategory($id);
        return $this->categoryRepository->destroy($category);
    }

    public function changeStatus($id){
        $category = $this->getCategory($id);
        return $this->categoryRepository->changeStatus($category);
    }

    public function getAllCategoriesExceptChildren($id){
        return $this->categoryRepository->getAllCategoriesExceptChildren($id);
    }
}
