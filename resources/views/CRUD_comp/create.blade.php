@extends('app.layout')

@section('title', 'Add Companies')

@section('bread', 'Add Companies')
@section('container')

<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Companies</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->

      <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="exampleFormControlSelect1">Name</label>
                    {{-- nama --}}
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Email</label>
                    {{-- Email --}}
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>

            <div class="form-group">
                <label>Logo</label>
                {{-- logo --}}
                    <input name="logo" type="file" class="form-control-file" id="logo" accept=".img, .jpg, .jpeg, .png" value="{{old('logo')}}">
            </div>

            <div class="form-group">
                <label>Website</label>
                {{-- website --}}
                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" id="website" placeholder="Enter Website" required value="{{ old('website') }}">
                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <a href="/companies" class="btn btn-outline-primary">
            <span>Cancel</span>
        </a>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
@endsection

