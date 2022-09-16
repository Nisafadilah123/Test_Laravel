@extends('app.layout')

@section('title', 'Edit Company')

@section('bread', 'Edit Company')
@section('container')

<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Company</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ url ('/companies', $company->id) }}" method="POST" enctype="multipart/form-data">
        {{-- <form action="{{ route ('companies.update', ['companies'=>$company]) }}" method="POST" enctype="multipart/form-data"> --}}

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
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required value="{{ucfirst(old('name', $company->name))}}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required value="{{ucfirst(old('email', $company->email))}}">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input name="logo" type="file" class="form-control-file" id="logo" accept=".img, .jpg, .jpeg, .png">
                <img src="/logo/{{($company->logo)}}" class="img-thumbnail" width="100px">
                <input name="logo" type="hidden" name="hidden_image" value="{{asset('logo/'. $company->logo)}}" class="form-control-file" id="hidden_image">
            </div>
            <div class="form-group">
                <label>Website</label>
                <input type="text" class="form-control" name="website" id="website" placeholder="Enter Website" required value="{{old('website', $company->website)}}">
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

