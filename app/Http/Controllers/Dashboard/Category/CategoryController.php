<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        //
        return view('dashboard.categories.index');
    }

    public function getAll(){
        return $this->categoryService->getAllCategoriesForDataTables();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->categoryService->getAllCategories();
        return view('dashboard.categories.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        $category = $this->categoryService->store($request);
        $category ? Session::flash('success', 'Category created successfully'):
            Session::flash('error', 'Something went wrong');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories = $this->categoryService->getAllCategoriesExceptChildren($id);
        $category = $this->categoryService->getCategoryWithChildrenCount($id);
        return view('dashboard.categories.edit' , compact('categories' , 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        $category = $this->categoryService->update($request , $id);
        $category ? Session::flash('success', 'Category updated successfully'):
            Session::flash('error', 'Something went wrong');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->categoryService->destroy($id);
        return redirect()->back();
    }

    public function changeStatus(string $id)
    {
        //
        $this->categoryService->changeStatus($id);
        return redirect()->back();
    }
}
