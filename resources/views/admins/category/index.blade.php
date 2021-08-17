@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/category/list/list.js') }}"></script>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   @include('partials.content-header',['name' => 'Categories', 'key' => 'List of'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2">Add a category</a>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Category parent name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if(empty($category->parent_name))
                                        {{ '-----' }}
                                    @else
                                    {{ $category->parent_name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit',['id' => $category->id]) }}" class="btn btn-default">Edit</a>
                                    <a href="" data-url="{{ route('categories.delete',['id' => $category->id]) }}" class="btn btn-danger action-delete-category">Delete</a>
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
