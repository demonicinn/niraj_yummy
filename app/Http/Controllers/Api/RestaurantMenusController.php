<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\Restaurants;
use App\Models\RestaurantMenus;

class RestaurantMenusController extends BaseController
{
    //...get
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        //...
        $checkRestaurant = Restaurants::where('name', 'like', '%'.$request['Name'].'%')
        ->where(function ($query) use ($request){
            if($request->group_code){
                $query->where('group_code', $request->group_code);
            } else {
                $query->whereNull('group_code');
            }
        })
        ->first();
        if($checkRestaurant){
            $restaurantMenu = RestaurantMenus::where('restaurant_id', $checkRestaurant->id)->first();

            return $this->sendResponse($restaurantMenu, 'Restaurant Menus retrieved successfully.');
        }

        return $this->sendError('Something went wrong.'); 
    }


    //...store
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'Menus' => 'required|array',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        //...
        $checkRestaurant = Restaurants::where('name', 'like', '%'.$request['Name'].'%')
        ->where(function ($query) use ($request){
            if($request->group_code){
                $query->where('group_code', $request->group_code);
            } else {
                $query->whereNull('group_code');
            }
        })
        ->first();
        if($checkRestaurant){
            $checkRestaurantMenu = RestaurantMenus::where('restaurant_id', $checkRestaurant->id)->first();

            //...
            $store = new RestaurantMenus;
            //...
            if($checkRestaurantMenu){
                $store->id = $checkRestaurantMenu->id;
                $store->exists = true;
            }
            $store->restaurant_id = $checkRestaurant->id;
            //...
            $store->appetizers = $request['Menus']['Appetizers'] ? json_encode($request['Menus']['Appetizers']) : '';
            $store->entree = $request['Menus']['Entree'] ? json_encode($request['Menus']['Entree']) : '';
            $store->desserts = $request['Menus']['Desserts'] ? json_encode($request['Menus']['Desserts']) : '';
            $store->drinks = $request['Menus']['Drinks'] ? json_encode($request['Menus']['Drinks']) : '';

            $store->save();

            return $this->sendResponse('', 'Restaurant menus updated successfully.');
        }


        return $this->sendError('Something went wrong.'); 
    }

}
