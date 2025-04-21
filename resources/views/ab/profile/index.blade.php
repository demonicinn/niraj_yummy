@extends('layouts.ab')
@section('title', 'Profile')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Update Profile</div>
        </div>
        {{ html()->model($user)->form('PUT', route('ab.profile.update'))->open() }}
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                {{ html()->text('first_name')->class('form-control'. ($errors->has('first_name') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('first_name', '<span class="help-block mb-1">:message</span>') !!}
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                {{ html()->text('last_name')->class('form-control'. ($errors->has('last_name') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('last_name', '<span class="help-block mb-1">:message</span>') !!}
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                {{ html()->email('email')->class('form-control'. ($errors->has('email') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('email', '<span class="help-block mb-1">:message</span>') !!}
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>

@endsection
