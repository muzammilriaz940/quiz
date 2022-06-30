@extends('adminlte::page')
@section('title', 'Exam '.$exam->name)
@section('content_header')
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-sm-12">
            <h1>@yield('title')</h1>
            <p class="text-danger">Click on best answers and SUBMIT at end after you review.</p>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\App\Models\TestQuestion::where('testId', $exam->testId)->orderBy('id', 'desc')->get() as $key => $question)
                                <div class="form-group col-md-12">
                                    <hr/>
                                    <label>Question # {{ ($key+1) }}</label>
                                    <hr/>
                                    <p>{{ $question->description }}</p>
                                </div>
                                    @foreach($question->options as $key2 => $value)
                                    <div class="form-group col-md-3">
                                        <input required type="radio" id="{{ $value }}" name="options[{{ $question->id }}][]" value="{{ $value }}">
                                        <label for="{{ $value }}">{{ $value }}</label><br>
                                    </div>
                                    @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ URL(\Request::url()) }}" class="btn btn-raised btn-danger mr-1">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                        <button type="submit" class="btn btn-raised btn-primary float-right">
                            <i class="fa fa-save"></i> Submit
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