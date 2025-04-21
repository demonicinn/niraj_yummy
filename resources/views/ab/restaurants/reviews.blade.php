@extends('layouts.ab')
@section('title', 'Restaurant Reviews')
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
                        <th>User</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($restaurantReviews as $data)
                        <tr class="align-middle">
                            <td>{{ $restaurantReviews->firstItem() + $loop->index }}</td>
                            <td><a href="{{ route('ab.users.show', $data->user->id) }}">{{ $data->user->name }}</a></td>
                            <td>{!! $data->review !!}</td>
                            <td>{{ $data->rating }}</td>
                            <td>
                                @if($data->image_path)
                                <img src="{{ $data->image_path }}" width="100" height="75">
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $restaurantReviews->links() }}
        </div>

    </div>
</div>

@endsection
