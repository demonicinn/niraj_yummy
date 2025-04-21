<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurants;
use App\Models\RestaurantReviews;

class RestaurantsController extends Controller
{
    //
    public $perPage;

    public function __construct() {
        $this->perPage = config('app.perPage');
    }


    public function index(Request $request)
    {
        $restaurantsData = Restaurants::paginate($this->perPage);
        $restaurantsData = Restaurants::where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
                if($request->user){
                    $query->whereHas('userRestaurants', function($query) use ($request) {
                        $query->where('user_id', $request->user);
                    });
                }
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('ab.restaurants.index', compact('restaurantsData'));
    }

    //show
    public function show(Request $request, Restaurants $restaurant)
    {
		$restaurant->load('restaurantMenus');

        return view('ab.restaurants.show', compact('restaurant'));
    }

    //show
    public function reviews(Request $request, Restaurants $restaurant)
    {
		$restaurantReviews = RestaurantReviews::where(function ($query) use ($request) {
                $query->where('review', 'like', '%'.$request->search.'%');
                if($request->user){
                    $query->where('user_id', $request->user);
                }
            })
            ->where('restaurant_id', $restaurant->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
            

        return view('ab.restaurants.reviews', compact('restaurant', 'restaurantReviews'));
    }
}
