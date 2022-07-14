@extends('adminlte::page')
@section('title', $EA->exam->name)
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
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="studentName">Name</label>
                                <input disabled type="text" class="form-control" value="{{ $EA->studentName }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="studentEmail">Email</label>
                                <input disabled type="studentEmail" class="form-control" value="{{ $EA->studentEmail }}">
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\App\Models\TestQuestion::orderBy('id')->where('testId', $EA->exam->testId)->get() as $key => $question)
                                <div class="form-group col-md-12">
                                    <hr/>
                                    <p><b>{{ ($key+1) }}.</b> {{ $question->description }}</p>
                                    <hr/>
                                </div>
                                    @foreach($question->options as $key2 => $value)
                                    <div class="form-group col-md-12">
                                        <input required type="radio" id="{{ $value.$question->id }}" name="question[{{ $question->id }}]" value="{{ ($key2+1) }}">
                                        <label for="{{ $value.$question->id }}">{{ $value }}</label><br>
                                    </div>
                                    @endforeach
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop
@section('js')
@stop