@extends('adminlte::page')
@section('title', 'View Test #'.$test->id)
@section('content_header')
<div class="container-fluid">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Success!</h5>
      {{ @$message }}.
      </div>
    @endif
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
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name">Name</label>
                            <input disabled type="text" class="form-control" value="{{ $test->name }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('tests.index') }}" class="btn btn-raised btn-warning mr-1">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-{{ $test->exams()->count() == 0 ? 6 : 12 }}">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    @foreach($test->questions()->get() as $key => $question)
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Question # {{ ($key+1) }}</label>
                            <hr>
                            <p>{{ $question->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <ol type="A">
                                @foreach($question->options as $key2 => $value)
                                    <li>{{ $value }}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="form-group col-md-{{ $test->exams()->count() == 0 ? 4 : 6 }}">
                            <label>Correct Option</label>
                            <p>{{ $question->correct_option }}</p>
                        </div>
                        <div class="form-group col-md-{{ $test->exams()->count() == 0 ? 4 : 6 }}">
                            <label>Total Marks</label>
                            <p>{{ $question->total_marks }}</p>
                        </div>
                        @if($question->exam_attempts()->count() == 0)
                        <div class="form-group col-md-4">
                            <label>Action</label>
                            <form action="{{ route('testquestions.destroy',$question->id) }}" method="POST">
                                <!-- <a class="btn btn-primary" href="{{ route('tests.edit',$test->id) }}">Edit</a> -->
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="testId" class="form-control" value="{{ $test->id }}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @if($test->exams()->count() == 0)
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <form action="{{ route('testquestions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="testId" class="form-control" value="{{ $test->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="description">Question</label>
                                <textarea required class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Option A</label>
                                <input required name="options[]" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Option B</label>
                                <input required name="options[]" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Option C</label>
                                <input required name="options[]" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Option D</label>
                                <input required name="options[]" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="correct_option">Correct Option</label>
                                <select class="form-control{{ $errors->has('correct_option') ? ' is-invalid' : '' }}" id="correct_option" name="correct_option">
                                    @foreach(['1'=>'A', '2'=>'B', '3'=>'C', '4'=>'D'] as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('correct_option'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correct_option') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label label="total_marks">Total Marks</label>
                                <input required name="total_marks" type="number" min="1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-raised btn-primary">
                            <i class="fa fa-save"></i> Add Question
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@stop

@section('css')
<style type="text/css">
    ol > li::marker {
      font-weight: bold;
    }
</style>
@stop
@section('js')
<script type="text/javascript">
  $('body').attr('class', 'sidebar-mini sidebar-collapse');
</script>
@stop