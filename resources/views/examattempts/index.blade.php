@extends('adminlte::page')
@section('title', 'Examp Attempt')
@section('content_header')
@stop

@section('content')
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-12">
            <h1>@yield('title')</h1>
            @if ($message = Session::get('info'))
            <p>{{ @$message }}</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
@stop
@section('js')
@stop