<?php

namespace App\Services\World;

use App\Models\Country;
use App\Repositories\World\WorldRepository;

class WorldService
{
    private $worldRepository;
    public function __construct(WorldRepository $worldRepository)
    {
        //
        $this->worldRepository = $worldRepository;
    }

    public function getAllCountries(){
        return $this->worldRepository->getAllCountries();
    }

    public function getAllGovernorates($id){
        $country = self::getCountyById($id);
        return $this->worldRepository->getAllGovernorates($country);
    }

    public function getAllCities($id){
        $governorate = self::getGovernorateById($id);
        return $this->worldRepository->getAllCities($governorate);
    }

    public function getCountyById($id){
        $country = $this->worldRepository->getCountryById($id);
        if(!$country){
            abort(404);
        }
        return $country;
    }


    public function getGovernorateById($id){
        $governorate = $this->worldRepository->getGovernorateById($id);
        if(!$governorate){
            abort(404);
        }
        return $governorate;
    }

    public function changeStatus($model)
    {
        $model = $this->worldRepository->changeStatus($model);
        if(!$model){
            return false;
        }
        return $model;
    }

    public function changePrice($gov_id, $price)
    {
        $shippingPrice = $this->worldRepository->changePrice($gov_id , $price);
        if(!$shippingPrice){
            return false;
        }
        return $shippingPrice;
    }
}
