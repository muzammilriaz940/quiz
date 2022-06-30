@extends('adminlte::page')
@section('title', 'Tests')
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
          <a href="{{ route('tests.create') }}" class="btn btn-primary">Add New</a>
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
                    <th width="280px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tests as $test)
                  <tr>
                    <td>{{ $test->id }}</td>
                    <td>{{ $test->name }}</td>
                    <td>
                      <form action="{{ route('tests.destroy',$test->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('tests.show',$test->id) }}">Manage</a>
                        <a class="btn btn-primary" href="{{ route('tests.edit',$test->id) }}">Edit</a>
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