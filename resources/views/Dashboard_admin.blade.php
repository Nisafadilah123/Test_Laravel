@extends('app.layout')

@section('title', 'Dashboard Admin')
@section('bread', 'Dashboard Admin')

@section('container')

<!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $companies }}</h3>

                <p>Companies</p>
              </div>
              <div class="icon">
                <i class="ion ion-build"></i>
              </div>
              <a href="/companies" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $employees }}</h3>

                <p>Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-build"></i>
              </div>
              <a href="/employees" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</section>

@endsection
