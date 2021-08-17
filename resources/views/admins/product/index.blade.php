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
   @include('partials.content-header',['name' => 'Products', 'key' => 'List of'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add a product</a>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td><img src="{{ $product->feature_image_path }}" style="max-width: 100px"/></td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    <a href="{{ route('product.edit',['id' => $product->id]) }}" class="btn btn-default">Edit</a>
                                    <a href="" data-url="{{ route('product.delete',['id' => $product->id]) }}" class="btn btn-danger action-delete">Delete</a>
                                </td>
                           </tr>
                        @endforeach


                    </tbody>
                  </table>
                  <!-- /.table -->
            </div>
            <!-- /.col-md-12 --> <div class="d-flex justify-content-center">
                {{ $list->links() }}
            </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

