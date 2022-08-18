@extends('adminlte::page')
@section('title', $EA->exam->name)
@section('content_header')
<div class="container-fluid">
    {{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Error!</h5>
        @foreach ($errors->all() as $error)
                {{ @$error }}<br>
        @endforeach
    </div>
    @endif --}}
    {{-- <div class="row text-center">
        <div class="col-sm-12">
            <h1>@yield('title')</h1>
        </div>
    </div> --}}
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>

        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h1>@yield('title')</h1>
                    <p>{{ $EA->studentName }}</p>
                    <p>{{ $EA->studentEmail }}</p>
                    <p>{{ explode(' ', $EA->created_at)[0] }}</p>
                </div>
            </div>

            @foreach($EA->exam->test->questions as $i => $question)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($question->options as $key => $value)
                        <?php
                        $dot = "";

                        $correctAnswer = $question->correct_option;
                        $option = ($key+1);
                        $attemptedAnswer = $EA->answers->where('testQuestionId', $question->id)->first()->answer;

                        if($correctAnswer == $option){
                            $dot = "is-valid";
                        }

                        if($attemptedAnswer == $option && empty($dot)){
                            $dot = "is-invalid";
                        }
                        ?>
                        @if($key == 0)
                        <div class="form-group col-md-12 {{ $attemptedAnswer == $correctAnswer ? 'text-success' : 'text-danger' }}">
                            <p><b>{{ ($i+1) }}.</b> {{ $question->description }}</p>
                        </div>
                        @endif
                        <div class="form-group col-md-12">
                            <p class="form-control no-border {{ $dot }}">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
@stop

@section('css')
<style type="text/css">
    .is-valid{
        background-color: #28a74538 !important;
        border: none !important;
    }

    .is-invalid{
        background-color: #dc354547 !important;
        border: none !important;
    }

    .no-border{
        border: none !important;
        margin-bottom: 0 !important;
    }
    
</style>
@stop
@section('js')
@stop