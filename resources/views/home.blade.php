@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{--  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  --}}
    @include('partials.content-header',['route' => route('home'),'name' => 'Home Page', 'key' => null])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

            </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="loginSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome {{ Auth::user()->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    You logged in with
                    @foreach(Auth::user()->roles as $role)
                        {{ $role->display_name }}
                    @endforeach
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#loginSuccess').modal('show');
        })
    </script>

@endsection

