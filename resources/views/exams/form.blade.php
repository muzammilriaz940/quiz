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
            
            {{-- <a href="{{ route('login-google') }}" class="google btn"><i class="fab fa-google"></i> Login with Google --}}
            </a>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <form action="{{ route('examattempts.store') }}" method="POST" id="exam-form">
                    @csrf
                    <input type="hidden" class="form-control" name="examId" value="{{ $exam->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h1>@yield('title')</h1>
                                <p>Use exact name / email used to register your BLS training.<br>Answer following 25 questions. Submit when finished.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="studentName">Name</label>
                                <input type="text" class="form-control{{ $errors->has('studentName') ? ' is-invalid' : '' }} exclude" id="studentName" name="studentName" value="{{ @$_COOKIE['studentName'] }}">
                                @if ($errors->has('studentName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('studentName') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="studentEmail">Email</label>
                                <input type="studentEmail" class="form-control{{ $errors->has('studentEmail') ? ' is-invalid' : '' }} exclude" id="studentEmail" name="studentEmail" value="{{ @$_COOKIE['studentEmail'] }}">
                                @if ($errors->has('studentEmail'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('studentEmail') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @foreach(\App\Models\TestQuestion::orderBy('id')->where('testId', $exam->testId)->get() as $key => $question)
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
                    <div class="card-footer">
                        <a href="#" class="btn btn-raised btn-danger mr-1" id="reset-btn">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                        <button type="submit" class="btn btn-raised btn-primary float-right">
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
@stop

@section('css')
<style type="text/css">
    .google {
        background-color: #dd4b39;
        color: white;
        cursor: pointer;
    }

    .google:hover {
        background-color: #dd4b39;
        color: white;
        cursor: pointer;
    }

    .content-wrapper {
        background: #e5edfa !important;
    }
</style>
@stop
@section('js')
<script type="text/javascript">
    $('.main-header').css('display', 'none');

    function formToString(filledForm) {
        formObject = new Object
        filledForm.find("input, select, textarea").each(function() {
            if (this.id) {
                elem = $(this);
                if (elem.attr("type") == 'checkbox' || elem.attr("type") == 'radio') {
                    if($(this).is(":checked")){
                        formObject[this.id] = elem.val();    
                    }
                } else {
                    formObject[this.id] = elem.val();
                }
            }
        });
        formString = JSON.stringify(formObject);
        return formString;
    }

    function stringToForm(formString, unfilledForm) {
        formObject = JSON.parse(formString);
        unfilledForm.find("input, select, textarea").each(function() {
            if (this.id) {
                id = this.id;
                elem = $(this); 
                if (elem.attr("type") == "checkbox" || elem.attr("type") == "radio" ) {
                    elem.attr("checked", formObject[id]);
                } else {
                    if(!$(this).hasClass('exclude')){
                        elem.val(formObject[id]);
                    }
                }
            }
        });
    }

    $(":input").on("keyup change", function(e) {
        localStorage.setItem("formdata", formToString($("#exam-form")));        
    });

    var storedform = localStorage.getItem("formdata");
    if(storedform.length > 0){
        stringToForm(storedform,$("#exam-form"));
    }

    $('#reset-btn').click(function(){
        localStorage.setItem("formdata", "");
        location.reload();
    });
</script>
@stop