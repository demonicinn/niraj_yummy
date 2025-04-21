@php
    $submitButton = 'Create';
    if(request()->segment(3) != 'create'){
        $submitButton = 'Update';
    }
@endphp



<div class="card-body">
    <div class="mb-3">
        <label class="form-label">First Name <sm>*</sm></label>
        {{ html()->text('first_name')->class('form-control'. ($errors->has('first_name') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('first_name', '<span class="help-block mb-1">:message</span>') !!}
    </div>
    <div class="mb-3">
        <label class="form-label">Last Name <sm>*</sm></label>
        {{ html()->text('last_name')->class('form-control'. ($errors->has('last_name') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('last_name', '<span class="help-block mb-1">:message</span>') !!}
    </div>
    <div class="mb-3">
        <label class="form-label">Email <sm>*</sm></label>
        {{ html()->email('email')->class('form-control'. ($errors->has('email') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('email', '<span class="help-block mb-1">:message</span>') !!}
    </div>


    <div class="mb-3">
        <label class="form-label">Password</label>
        {{ html()->password('password')->class('form-control'. ($errors->has('password') ? ' is-invalid' : '')) }}
        {!! $errors->first('password', '<span class="help-block mb-1">:message</span>') !!}
    </div>
    <div class="mb-3">
        <label class="form-label">Password Confirmation</label>
        {{ html()->password('password_confirmation')->class('form-control'. ($errors->has('password_confirmation') ? ' is-invalid' : '')) }}
        {!! $errors->first('password_confirmation', '<span class="help-block mb-1">:message</span>') !!}
    </div>


    <div class="mb-3">
        <label class="form-label">DOB <sm>*</sm></label>
        {{ html()->date('dob')->class('form-control'. ($errors->has('dob') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('dob', '<span class="help-block mb-1">:message</span>') !!}
    </div>
    <div class="mb-3">
        <label class="form-label">Number <sm>*</sm></label>
        {{ html()->number('number')->class('form-control'. ($errors->has('number') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('number', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    <div class="mb-3">
        <label class="form-label">Image </label>

        @if (isset($user) && $user->image)
            </br>
            <img src="{{ $user->image_path }}" height="150" width="150">
        @endif
        {{ html()->file('image')->class('form-control'. ($errors->has('image') ? ' is-invalid' : ''))->accept(env('IMAGE_MIME')) }}
        {!! $errors->first('image', '<span class="help-block mb-1">:message</span>') !!}
    </div>


    <div class="mb-3">
        <label class="form-label">Status <sm>*</sm></label>
        {{ html()->select('status')->class('form-control'. ($errors->has('status') ? ' is-invalid' : ''))->options(statusArray()) }}
        {!! $errors->first('status', '<span class="help-block mb-1">:message</span>') !!}
    </div>

</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
</div>

@section('script')
<script>
    function deleteAttachment(id){
        if(confirm("Are you sure you want to delete this?")){
            $('.btn-group.attach'+id).remove();
        }
        else{
            return false;
        }
    }
</script>
@endsection