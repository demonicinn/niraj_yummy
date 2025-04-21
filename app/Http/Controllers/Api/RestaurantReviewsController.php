<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\Restaurants;
use App\Models\RestaurantReviews;

class RestaurantReviewsController extends BaseController
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
        $checkRestaurant = Restaurants::where('name', 'like', '%'.$request['Name'].'%')->first();
        if($checkRestaurant){
            $restaurantReviews = RestaurantReviews::where('restaurant_id', $checkRestaurant->id)
                ->where('user_id', auth()->user()->id)
                ->get();


            return $this->sendResponse($restaurantReviews, 'Restaurant reviews retrieved successfully.');
        }


        return $this->sendError('Something went wrong.'); 
    }


    //...store
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required',
            'review' => 'required',
            'rating' => 'required',
            'image' => 'required|image|max:1024'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        //...
        $checkRestaurant = Restaurants::where('name', 'like', '%'.$request['Name'].'%')->first();
        if($checkRestaurant){
            //...
            $store = new RestaurantReviews;
            $store->user_id = auth()->user()->id;
            $store->restaurant_id = $checkRestaurant->id;
            //...
            $store->review = $request['review'];
            $store->rating = $request['rating'];

            //...files
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                
                $filename = time().'.'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $path = $file->storeAs('reviews', $filename, 'public');
            
                //...
                $store->image = $filename;
            }

            $store->save();

            return $this->sendResponse('', 'Restaurant review added successfully.');
        }


        return $this->sendError('Something went wrong.'); 
    }
}
