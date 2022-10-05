@extends('adminlte::page')
@section('title', 'New User')
@section('content_header')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1>@yield('title')</h1>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="instructorNo">Instructor #</label>
                                <input type="text" class="form-control{{ $errors->has('instructorNo') ? ' is-invalid' : '' }}" id="instructorNo" name="instructorNo" value="{{ old('instructorNo') }}">
                                @if ($errors->has('instructorNo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('instructorNo') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="instructorInitials">Initials</label>
                                <input type="text" class="form-control{{ $errors->has('instructorInitials') ? ' is-invalid' : '' }}" id="instructorInitials" name="instructorInitials" value="{{ old('instructorInitials') }}">
                                @if ($errors->has('instructorInitials'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('instructorInitials') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input autocomplete="off" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password">Password</label>
                                <input autocomplete="off" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-raised btn-warning mr-1">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-raised btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop
@section('js')
@stop