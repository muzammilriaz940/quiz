@extends('adminlte::page')
@section('title', 'Success')
@section('content_header')
@stop

@section('content')
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-12">
            <h1>@yield('title')</h1>
            <p class="text-danger">We've got your submission.</p>
        </div>
    </div>
</div>
@stop

@section('css')
@stop
@section('js')
@stop