@extends('app.layout')

@section('title', 'Add Employees')

@section('bread', 'Add Employees')
@section('container')

<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Employees</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->

      <form action="{{ route('employees.store') }}" method="POST">
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
                <label for="exampleFormControlSelect1">First Name</label>
                    {{-- first name --}}
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Last Name</label>
                    {{-- last name --}}
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
            <div class="form-group ">
                <label>Company</label>
                    <select class="form-control" id="id_companies" name="id_companies">
                        {{-- id companies --}}
                        <option hidden> Choose Company</option>
                        @foreach ($comp as $c)
                            <option value="{{$c->id}}">{{ $c->name }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Email</label>
                    {{-- email --}}
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Phone</label>
                    {{-- phone --}}
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter Phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <a href="/employees" class="btn btn-outline-primary">
            <span>Cancel</span>
        </a>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection

