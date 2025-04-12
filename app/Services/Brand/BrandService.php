<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepository;
use App\Traits\ImageManagementTrait;
use Yajra\DataTables\Facades\DataTables;

class BrandService
{
    use ImageManagementTrait;
    private $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        //
        $this->brandRepository = $brandRepository;
    }


    public function getAllBrandsForDataTables()
    {

        $brands = $this->brandRepository->getBrands();
        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('status', function ($brand) {
                return $brand->getStatus();
            })
            ->addColumn('name', function ($brand) {
                return $brand->getTranslation('name', app()->getLocale());
            })
            ->addColumn('logo', function ($brand) {
                return view('dashboard.brands.datatables.logo', compact('brand'));
            })
            ->addColumn('products_count', function ($brand) {
                return $brand->products_count == 0 ? __('dashboard.not_found') : $brand->products_count;
            })
            ->addColumn('action', function ($brand) {
                return view('dashboard.brands.datatables.actions', compact('brand'));
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
    }

    public function store($request){
        $this->uploadImage($request->file('logo'));
        $this->brandRepository->store($request);
    }

    public function uploadImage($image){
        return $this->uploadImageToDisk('images/brands' , $image);
    }
}
