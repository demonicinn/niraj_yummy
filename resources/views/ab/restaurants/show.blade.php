@extends('layouts.ab')
@section('title', 'Restaurant Details')
@section('content')
@php
    $hasUser = '';
    if(request()->user){
        $hasUser = '?user='.request()->user;
    }
@endphp
<div class="col-12">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Restaurant Details</div>
            <div class="float-end">

                <a href="{{ route('ab.restaurants.reviews', $restaurant->id) }}{{ $hasUser }}"
                    class="btn btn-success btn-sm">Reviews</a>

                <a href="{{ route('ab.restaurants') }}" class="btn btn-warning btn-sm"><i
                    class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">

                    <div class="col-12">
                        <div class="text-truncate"><b>Name:</b> {{ $restaurant->name }}</div>
                        <div class="text-truncate"><b>Description:</b> {{ $restaurant->description }}</div>
                        <div class="text-truncate"><b>Type:</b> {{ $restaurant->type }}</div>
                        <div class="text-truncate"><b>Capacity:</b> {{ $restaurant->capacity }}</div>
                        <div class="text-truncate"><b>Latitue:</b> {{ $restaurant->latitue }}</div>
                        <div class="text-truncate"><b>Longitude:</b> {{ $restaurant->longitude }}</div>
                        <div class="text-truncate"><b>Booking Mode:</b> {{ $restaurant->booking_mode }}</div>
                        <div class="text-truncate"><b>Website Link:</b> 
                            @if($restaurant->website_link)
                            <a target="_blank" href="{{ $restaurant->website_link }}">{{ $restaurant->website_link }}</a>
                            @endif
                        </div>
                        <div class="text-truncate"><b>Rating:</b> {{ $restaurant->rating }}</div>
                        <div class="text-truncate"><b>Total User Rating:</b> {{ $restaurant->user_ratings_total }}</div>
                        <div class="text-truncate"><b>Address:</b> {{ $restaurant->formatted_address }}</div>
                        <div class="text-truncate"><b>Phone Number:</b> {{ $restaurant->formatted_phone_number }}</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">
                    <div class="col-12">
                        <h4>Editorial Summary:</h4>
                        <div class="text-truncate">{{ $restaurant->editorial_summary->overview }}</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">
                    <div class="col-12">
                        <h4>Opening Hours:</h4>
                        @foreach($restaurant->opening_hours->weekday_text as $hours)
                        <div class="text-truncate">{{ $hours }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>




@if($restaurant->restaurantMenus)
@php $menu = $restaurant->restaurantMenus; @endphp
<h3>Menus</h3>

@include('ab.restaurants.menu', ['data'=>$menu->appetizers, 'title'=>'Appetizers'])
@include('ab.restaurants.menu', ['data'=>$menu->entree, 'title'=>'Entree'])
@include('ab.restaurants.menu', ['data'=>$menu->desserts, 'title'=>'Desserts'])
@include('ab.restaurants.menu', ['data'=>$menu->drinks, 'title'=>'Drinks'])

@endif

@endsection