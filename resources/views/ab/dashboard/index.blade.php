@extends('layouts.ab')
@section('title', 'Dashboard')
@section('content')


<div class="app-content">
    <div class="container-fluid">

    @include('ab.dashboard.total')

    </div>
</div>

  
@endsection