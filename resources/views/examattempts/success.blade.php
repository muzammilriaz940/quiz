@extends('adminlte::page')
@section('title', $exam->name)
@section('content_header')
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Error!</h5>
        @foreach ($errors->all() as $error)
                {{ @$error }}<br>
        @endforeach
    </div>
    @endif
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
                <form action="{{ route('examattempts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="examId" value="{{ $exam->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="studentName">Name</label>
                                <input type="text" class="form-control{{ $errors->has('studentName') ? ' is-invalid' : '' }}" id="studentName" name="studentName" value="{{ old('studentName') }}">
                                @if ($errors->has('studentName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('studentName') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="studentEmail">Email</label>
                                <input type="studentEmail" class="form-control{{ $errors->has('studentEmail') ? ' is-invalid' : '' }}" id="studentEmail" name="studentEmail" value="{{ old('studentEmail') }}">
                                @if ($errors->has('studentEmail'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('studentEmail') }}</strong>
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
                                        <input required type="radio" id="{{ $value }}" name="question[{{ $question->id }}]" value="{{ $value }}">
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