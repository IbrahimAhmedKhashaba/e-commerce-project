<?php

namespace App\Http\Controllers\Dashboard\World;

use App\Http\Controllers\Controller;
use App\Services\World\WorldService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorldController extends Controller
{
    //
    protected $worldService;
    public function __construct(WorldService $worldService){
        $this->worldService = $worldService;
    }

    public function getAllCountries(){
        $countries = $this->worldService->getAllCountries();
        return view('dashboard.world.countries' , compact('countries'));
    }

    public function getAllGovernorates($id){
        $governorates = $this->worldService->getAllGovernorates($id);
        return view('dashboard.world.governorates' , compact('governorates'));
    }

    public function changeStatus($id){
        $country = $this->worldService->getCountyById($id);
        $country = $this->worldService->changeStatus($country);
        if(!$country){
            return response()->json(['status' => false , 'message' => 'Country not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $country
        ] , 200);
    }

    public function changeGovernorateStatus($id){
        $governorate = $this->worldService->getGovernorateById($id);
        $governorate = $this->worldService->changeStatus($governorate);
        if(!$governorate){
            return response()->json(['status' => false , 'message' => 'governorate not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $governorate
        ] , 200);
    }

    public function ChangeShippingPrice(Request $request){
        $request->validate([
            'price' => 'required|numeric'
        ]);
        $governorate = $this->worldService->changePrice($request->gov_id , $request->price);
        if(!$governorate){
            return response()->json(['status' => false , 'message' => 'governorate not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $governorate
        ] , 200);

    }
}
