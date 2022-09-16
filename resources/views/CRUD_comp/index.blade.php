@extends('app.layout')

@section('title', 'Companies')

@section('bread', 'Companies')
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
                                    <a href="{{ url('companies/create') }}" type="button" class="btn btn-success">Add</a><br><br>

                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Logo</th>
                                        <th>Website</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($comps as $c)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                        <td style="vertical-align: middle;">{{$c->name}}</td>
                                        <td style="vertical-align: middle;">{{$c->email}}</td>
                                        <td style="vertical-align: middle;"><img src="/logo/{{$c->logo}}" width="100px"></td>

                                        <td style="vertical-align: middle;"><a href="{{$c->website}}" target="_blank">Kunjungi</a></td>
                                        <td class="text-center">
                                            <form action="{{ route('companies.destroy',$c->id) }}" method="POST">

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
        </div>

    </section>
</div>
    <!-- /.content -->
    @foreach ($comps as $c)
        <!-- Edit Modal -->
        <div class="modal fade" id="ModalUbah{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                            <div class="modal-body">
                                            <form action="{{ url ('/companies', $c->id) }}" method="POST" enctype="multipart/form-data">
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
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="Full of Name" required value="{{ucfirst(old('name', $c->name))}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Full of Email" required value="{{ucfirst(old('email', $c->email))}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Logo</label>
                                                        <input name="logo" type="file" class="form-control-file" id="logo" accept=".img, .jpg, .jpeg, .png">
                                                        <img src="/logo/{{($c->logo)}}" class="img-thumbnail" width="100px">
                                                        <input name="logo" type="hidden" name="hidden_image" value="{{asset('logo/'. $c->logo)}}" class="form-control-file" id="hidden_image">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" class="form-control" name="website" id="website" placeholder="Full of Website" required value="{{old('website', $c->website)}}">
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
