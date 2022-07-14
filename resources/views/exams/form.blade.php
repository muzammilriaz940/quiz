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
                <form action="{{ route('examattempts.store') }}" method="POST" id="exam-form">
                    @csrf
                    <input type="hidden" class="form-control" name="examId" value="{{ $exam->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="studentName">Name</label>
                                <input type="text" class="form-control{{ $errors->has('studentName') ? ' is-invalid' : '' }}" id="studentName" name="studentName">
                                @if ($errors->has('studentName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('studentName') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="studentEmail">Email</label>
                                <input type="studentEmail" class="form-control{{ $errors->has('studentEmail') ? ' is-invalid' : '' }}" id="studentEmail" name="studentEmail">
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
    </div>
</div>
@stop

@section('css')
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
                    if($('#' + this.id).is(":checked")){
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
                    elem.val(formObject[id]);
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