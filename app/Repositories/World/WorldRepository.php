<?php

namespace App\Repositories\World;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;

class WorldRepository
{
    public function getAllCountries()
    {
        return Country::when(request()->has('keyword') , function($query){
            $query->where('name' , 'like' , '%'.request()->keyword.'%');
        })
        ->select(['id' , 'name' , 'is_active' , 'phone_code' , 'flag_code'])->withCount(['governorates' , 'users'])->paginate(10);
    }

    public function getAllGovernorates($country)
    {
        return $country->governorates()->when(request()->has('keyword') , function($query){
            $query->where('name' , 'like' , '%'.request()->keyword.'%');
        })->with('country' , 'shippingPrice')->withCount(['users' , 'cities'])->paginate(10);
    }

    public function getAllCities($governorate)
    {
        return $governorate->cities;
    }

    public function getCountryById($id)
    {
        return Country::find($id);
    }

    public function getGovernorateById($id)
    {
        return Governorate::with('cities' , 'shippingPrice')->find($id);
    }

    public function changeStatus($model)
    {
        $model->is_active = $model->is_active == 'Active' || $model->is_active == 'مفعل' ? 0:1;
        $model->save();
        return $model;
    }

    public function changePrice($gov_id , $price)
    {
        $shippingPrice = ShippingGovernorate::where('id' , $gov_id)->first();
        $shippingPrice->price = $price;
        $shippingPrice->save();
        return $shippingPrice;
    }


}
