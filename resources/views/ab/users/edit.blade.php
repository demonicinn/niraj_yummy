@extends('layouts.ab')
@section('title', 'Edit User')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Edit User</div>
            <a href="{{ route('ab.users') }}" class="btn btn-warning btn-sm float-end"><i
                    class="nav-icon bi bi-arrow-left"></i></a>
        </div>

        {{ html()->model($user)->form('PATCH', route('ab.users.edit', $user->id))->acceptsFiles()->open() }}

        @include('ab.users.form')

        {{ html()->form()->close() }}
    </div>
</div>

@endsection
