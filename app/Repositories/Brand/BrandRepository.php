<?php

namespace App\Repositories\Brand;

use App\Models\Brand;

class BrandRepository
{
    public function getBrands()
    {
        return Brand::all();
    }

    public function getBrand($id)
    {
        return Brand::find($id);
    }

    public function store($request)
    {
        return Brand::create([
            'name' => $request->name,
            
        ]);
    }
}
