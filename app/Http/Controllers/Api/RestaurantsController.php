<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\Restaurants;
use App\Models\UserRestaurants;

class RestaurantsController extends BaseController
{
    //...get
    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        $userRestaurant = Restaurants::whereHas('userRestaurants', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        

        return $this->sendResponse($userRestaurant, 'User Restaurants retrieved successfully.');
    }

    //...store
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $user = auth()->user();

        //add multiple Restaurants
        foreach($request->data as $data){
            //...
            $checkRestaurant = Restaurants::where('name', 'like', '%'.$data['name'].'%')->first();

            //...
            $store = new Restaurants;
            //...
            if($checkRestaurant){
                $store->id = $checkRestaurant->id;
                $store->exists = true;
            }
            $store->name = $data['name'];
            $store->description = $data['description'];
            $store->type = $data['type'];
            $store->capacity = $data['capacity'];
            $store->latitue = $data['latitue'];
            $store->longitude = $data['longitude'];
            $store->booking_mode = $data['booking_mode'];
            $store->last_updated = $data['last_updated'];
            $store->open_now = $data['open_now'];
            $store->website_link = $data['website_link'];
            $store->distance = $data['distance'];
            $store->rating = $data['rating'];
            $store->user_ratings_total = $data['user_ratings_total'];
            $store->place_id = $data['place_id'];
            $store->image_url = $data['image_url'];
            $store->formatted_address = $data['formatted_address'];
            $store->formatted_phone_number = $data['formatted_phone_number'];
            //...
            $store->editorial_summary = json_encode($data['editorial_summary']);
            $store->geometry = json_encode($data['geometry']);
            $store->opening_hours = json_encode($data['opening_hours']);
            $store->photos = json_encode($data['photos']);
            $store->reviews = json_encode($data['reviews']);

            $store->save();


            //...
            //store in user Restaurants
            
            $checkUserRestaurant = UserRestaurants::where('user_id', $user->id)
                ->where('restaurant_id', $store->id)
                ->first();

            //...
            $userRestaurant = new UserRestaurants;
            //...
            if($checkUserRestaurant){
                $userRestaurant->id = $checkUserRestaurant->id;
                $userRestaurant->exists = true;
            }
            $userRestaurant->user_id = $user->id;
            $userRestaurant->restaurant_id = $store->id;
            $userRestaurant->save();
        }
        
        


        return $this->sendResponse('', 'Restaurants updated successfully.');
    }
}
