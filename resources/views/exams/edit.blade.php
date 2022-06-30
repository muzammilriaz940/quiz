@extends('adminlte::page')
@section('title', 'Edit Exam #'. $exam->id)
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
                 <form action="{{ route('exams.update',$exam->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $exam->name) }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="testId">Test</label>
                                <select class="form-control{{ $errors->has('testId') ? ' is-invalid' : '' }}" id="testId" name="testId">
                                    <option value="">Please Select</option>
                                    @foreach(\App\Models\Test::all() as $test)
                                    <option value="{{ $test->id }}" {{ old('testId', $exam->testId) == $test->id ? 'selected' : '' }}>{{ $test->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('testId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('testId') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="active">Status</label>
                                <select class="form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" id="active" name="active">
                                    <option value="1" {{ old('active', $exam->active) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('active', $exam->active) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @if ($errors->has('active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('active') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('exams.index') }}" class="btn btn-raised btn-warning mr-1">
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