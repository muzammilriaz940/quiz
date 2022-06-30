@extends('adminlte::page')
@section('title', 'Exams')
@section('content_header')
<div class="container-fluid">
  <section id="multi-column">
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Success!</h5>
      {{ @$message }}.
      </div>
    @endif
    <div class="row">
      <div class="col-md-6">
        <h1>@yield('title')</h1>
      </div>
      <div class="col-md-6">
        <div class="btn-group float-right">
          <a href="{{ route('exams.create') }}" class="btn btn-primary">Add New</a>
        </div>
      </div>
    </div>
  </section>
</div>
@stop

@section('content')
<div class="container-fluid">
  <section id="multi-column">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-body collapse show">
            <div class="card-block table-responsive">
              <table class="table table-bordered table-striped table-hover datatable" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Test</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($exams as $exam)
                  <tr>
                    <td>{{ $exam->id }}</td>
                    <td>{{ $exam->name }}</td>
                    <td>{{ @\App\Models\Test::find($exam->testId)->pluck('name')->first(); }}</td>
                    <td>{{ \Request::root().'/exam/'.$exam->url }}</td>
                    <td>{{ $exam->active }}</td>
                    <td>
                      <form action="{{ route('exams.destroy',$exam->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('exams.show',$exam->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('exams.edit',$exam->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@stop

@section('css')
@stop
@section('js')
@stop