@extends('app.layout')

@section('title', 'Edit Employees')

@section('bread', 'Edit Employees')
@section('container')

<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Employees</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ url ('/employees', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{  ($error)  }}</li>

                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name" required value="{{ucfirst(old('first_name', $employee->first_name))}}">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required value="{{ucfirst(old('last_name', $employee->last_name))}}">
            </div>
            <div class="form-group ">
                <label>Name Company</label>
                <select class="form-control" id="id_companies" name="id_companies">
                    {{-- name company --}}
                    @foreach ($comp as $c)
                        <option value="{{$c->id}}" {{ $c->id === $employee->id_companies ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required value="{{ucfirst(old('email', $employee->email))}}">
            </div>

            <div class="form-group">
                <label>No. Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter No. Phone" required value="{{old('phone', $employee->phone)}}">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
          <a href="/companies" class="btn btn-outline-primary">
            <span>Cancel</span>
        </a>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection

@push('script-addon')

@endpush

