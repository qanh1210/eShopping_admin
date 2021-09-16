@extends('layouts.admin')

@section('title')
    <title>Product</title>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   @include('partials.content-header',['route' => route('product.index'),'name' => 'Products', 'key' => 'List of'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add a product</a>
            </div>
            <div class="col-md-12">
                <div id="table-data">
                    @include('admins.product.list')
                </div>
                </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

