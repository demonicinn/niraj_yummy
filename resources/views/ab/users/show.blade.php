@extends('layouts.ab')
@section('title', 'User Details')
@section('content')

<div class="col-12">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">User Details</div>
            <div class="float-end">

                <a href="{{ route('ab.restaurants') }}?user={{ $user->id }}" class="btn btn-success btn-sm">Restaurants</a>
                
                <a href="{{ route('ab.users.edit', $user->id) }}"
                    class="btn btn-warning btn-sm">Edit</a>

                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.users.delete', $user->id) }}"
                    class="btn btn-danger btn-sm">Delete</a>

                <a href="{{ route('ab.users') }}" class="btn btn-warning btn-sm"><i
                    class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">
                    <div class="col-12">
                        <div class="text-truncate"><b>Name:</b> {{ $user->name }}</div>
                        <div class="text-truncate"><b>Email:</b> {{ $user->email }}</div>
                        <div class="text-truncate"><b>DOB:</b> {{ $user->dob }}</div>
                        <div class="text-truncate"><b>Number:</b> {{ $user->number }}</div>
                        <div class="text-truncate"><b>Status:</b> {{ statusValue($user->status) }}</div>
                        <div class="text-truncate"><b>Image:</b> 
                            @if($user->image_path)
                            </br>
                            <img src="{{ $user->image_path }}" width="200" height="200">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

@if($user->preferences)
@php $preferences = $user->preferences->data; @endphp
<div class="col-12">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Preferences</div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Key</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($preferences as $i => $preference)
                        <tr class="align-middle">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $preference->key }}</td>
                            <td>{{ $preference->value }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        
    </div>
</div>
@endif

@endsection
