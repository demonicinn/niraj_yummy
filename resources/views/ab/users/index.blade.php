@extends('layouts.ab')
@section('title', 'Users')
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $data)
                        <tr class="align-middle">
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                @if($data->image_path)
                                <img src="{{ $data->image_path }}" width="100" height="75">
                                @endif
                            </td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->dob }}</td>
                            <td>{{ $data->number }}</td>
                            <td>{{ statusValue($data->status) }}</td>
                            <td>
                                <a href="{{ route('ab.users.show', $data->id) }}"
                                    class="btn btn-primary btn-sm">Details</a>

                                    <a href="{{ route('ab.users.edit', $data->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>

                                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.users.delete', $data->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>

    </div>
</div>

@endsection
