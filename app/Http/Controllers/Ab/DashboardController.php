<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurants;


class DashboardController extends Controller
{
    //
    public function dashboard()
    {

        $data['usersCount'] = User::where('role', 'user')->count();
        $data['restaurantsCount'] = Restaurants::count();


        return view('ab.dashboard.index', compact('data'));
    }


}
