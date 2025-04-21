@extends('layouts.ab')
@section('title', 'Restaurants')
@section('content')

<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">

            <div class="row">
                <div class="col-4">
                    @include('components.search')
                </div>
            </div>


        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>website_link</th>
                        <th>Rating</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $hasUser = '';
                        if(request()->user){
                            $hasUser = '?user='.request()->user;
                        }
                    @endphp
                    @foreach($restaurantsData as $data)
                        <tr class="align-middle">
                            <td>{{ $restaurantsData->firstItem() + $loop->index }}</td>
                            <td><a href="{{ route('ab.restaurants.show', $data->id) }}">{{ $data->name }}</a></td>
                            <td>{{ $data->type }}</td>
                            <td>{{ $data->capacity }}</td>
                            <td>
                                @if($data->website_link)
                                <a href="{{ $data->website_link }}">Link</a>
                                @endif
                            </td>
                            <td>{{ $data->rating }}</td>
                            <td>
                                <a href="{{ route('ab.restaurants.show', $data->id) }}{{ $hasUser }}"
                                    class="btn btn-primary btn-sm">Details</a>

                                <a href="{{ route('ab.restaurants.reviews', $data->id) }}{{ $hasUser }}"
                                        class="btn btn-success btn-sm">Reviews</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $restaurantsData->links() }}
        </div>

    </div>
</div>

@endsection
