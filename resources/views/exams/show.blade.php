@extends('adminlte::page')
@section('title', 'View Exam #'.$exam->id)
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
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input disabled type="text" class="form-control" id="name" name="name" value="{{ $exam->name }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="testId">Test</label>
                                <select disabled class="form-control" id="testId" name="testId">
                                    <option value="">Please Select</option>
                                    @foreach(\App\Models\Test::all() as $test)
                                    <option value="{{ $test->id }}" {{ $exam->testId == $test->id ? 'selected' : '' }}>{{ $test->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="active">Status</label>
                                <select disabled class="form-control" id="active" name="active">
                                    <option value="1" {{ $exam->active == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $exam->active == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('exams.index') }}" class="btn btn-raised btn-warning mr-1">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
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