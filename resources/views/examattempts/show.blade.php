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
                    <h2>You have completed the BLS Provider Course Exam<br>Thank you!</h2><br>
                    <p><button type="button" id="show-score" class="btn btn-primary">View Score</button></p>
                    <p><a href="{{ URL('exam/'.$EA->exam->url) }}"><u>Submit another respose</u></a></p>
                </div>
            </div>

            <div id="score-div" class="hidden">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <?php
                            $score = 0;
                            foreach($EA->answers as $answer){
                                @$totalMarks += $answer->question->total_marks;
                                if($answer->question->correct_option ==  $answer->answer){
                                    $score += $answer->question->total_marks;
                                }
                            }
                        ?>
                        <span><h1>@yield('title')</h1> <span style="float: right;"><b>{{ $score }} of {{ $totalMarks }} points</span></b></span>
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

    .hidden{
        display: none;
    }   

    .content-wrapper {
        background: #e5edfa !important;
    }  

    body {
        background: #e5edfa !important;
    } 
</style>
@stop
@section('js')
<script type="text/javascript">
    $('#show-score').click(function(e){
        e.preventDefault();
        $('#score-div').toggle();
    });

    $('.main-header').css('display', 'none');
    localStorage.setItem("formdata", "");
</script>
@stop