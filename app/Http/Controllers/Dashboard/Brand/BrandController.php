<?php

namespace App\Http\Controllers\Dashboard\Brand;

use App\Http\Controllers\Controller;
use App\Services\Brand\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brandService;
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    public function index()
    {
        //
        return view('dashboard.brands.index');
    }

    public function getALl(){
        return $this->brandService->getAllBrandsForDataTables();
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
