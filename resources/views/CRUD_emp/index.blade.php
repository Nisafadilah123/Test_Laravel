@extends('app.layout')

@section('title', 'Employees')

@section('bread', 'Employees')
@section('container')

    <!-- Main content -->
    <div class="main-content">
    <section class="section">

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">


                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered data" id="add-row">
                                    <a href="{{ url('employees/create') }}" type="button" class="btn btn-success">Add</a><br><br>

                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th>No. Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($emps as $c)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                        <td style="vertical-align: middle;">{{$c->first_name}} {{ $c->last_name }}</td>
                                        <td style="vertical-align: middle;">{{$c->company->name}}</td>
                                        <td style="vertical-align: middle;">{{$c->email}}</td>
                                        <td style="vertical-align: middle;">{{$c->phone}}</td>
                                        <td class="text-center">
                                            <form action="{{ route('employees.destroy',$c->id) }}" method="POST">

                                                {{-- <a class="btn btn-primary btn-sm" href="{{ url('employees/'.$c->id.'/edit') }}">Edit</a> --}}
                                                <button type="button" class="btn btn-primary edit" data-id="{{$c->id}}" data-toggle="modal" data-target="#ModalUbah{{ $c->id }}">Edit</button>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm delete" >Delete</button>
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
        </div>

    </section>
</div>
    <!-- /.content -->
    @foreach ($emps as $d)
        <!-- Edit Modal -->
        <div class="modal fade" id="ModalUbah{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                            <div class="modal-body">
                                <form action="{{ url ('/employees', $d->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Full of First Name" required value="{{ucfirst(old('first_name', $d->first_name))}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Full of Last Name" required value="{{ucfirst(old('last_name', $d->last_name))}}">
                                        </div>
                                        <div class="form-group ">
                                            <label>Name Company</label>
                                            <select class="form-control" id="id_companies" name="id_companies">
                                                {{-- name company --}}
                                                @foreach ($company as $c)
                                                    <option value="{{$c->id}}" {{ $c->id === $d->id_companies ? 'selected' : '' }}>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required value="{{ucfirst(old('email', $d->email))}}">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukkan phoneripsi Berita" required value="{{old('website', $d->phone)}}">
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

                                </div>
                            </div>
                            {{-- end edit modal --}}
        </div>
    @endforeach

<!-- page script -->
  @endsection

  @push('script-addon')

<script>
$(document).ready( function () {
    $('.data').DataTable();
} );
</script>

<script>
    $('.delete').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
            title: `Apakah anda yakin ingin menghapus data ini ?`,
              text: "Jika anda menghapusnya maka datanya akan di hapus secara permanen",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@endpush
