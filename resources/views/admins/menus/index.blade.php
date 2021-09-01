@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   @include('partials.content-header',['route' => route('menus.index'),'name' => 'Menu', 'key' => 'List of'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Menu name</th>
                        <th scope="col">Parent Menu</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if(empty($item->parent_name))
                                        {{ '-----' }}
                                    @else
                                    {{ $item->parent_name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('menus.edit',['id' => $item->id]) }}" class="btn btn-default">Edit</a>
                                    <a href="{{ route('menus.delete',['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
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
