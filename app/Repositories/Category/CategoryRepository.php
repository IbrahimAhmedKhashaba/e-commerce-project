<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function getAllCategories(){
        return Category::withCount('products')->get();
    }

    public function getCategory($id){
        return Category::find($id);
    }

    public function getCategoryWithChildrenCount($id){
        return Category::withCount('children')->find($id);
    }

    public function store($request){
        return Category::create([
            'name' => $request->name,
            'parent' => $request->parent,
            'status' => $request->status,
        ]);
    }

    public function destroy($category){
        $category->delete();
        return true;
    }

    public function changeStatus($category){
        $category->status = $category->status == 'Active' || $category->status == 'مفعل' ? $category->status = 0 : $category->status = 1;
        $category->save();
        return $category;
    }

    public function update($category, $request){
        $category->name = $request->name;
        $category->parent = $request->parent ? $request->parent : $category->parent;
        $category->status = $request->status;
        $category->save();
        return $category;
    }

    public function delete($category){
        return $category->delete();
    }

    public function getAllCategoriesExceptChildren($id){
        return  Category::where('id', '!=', $id)
        ->whereNull('parent')
        ->get();
    }
}
