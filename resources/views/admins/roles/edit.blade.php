@extends('layouts.admin')

@section('title')
    <title>Edit role</title>
@endsection

@section('css')
<link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet" />
<style>
    .card-header{
        background-color: #ffdf7e;
    }

</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['route' => route('roles.index'),'name' => 'Role', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <form action="{{ route('roles.update',['id'=> $roleEdit->id]) }}" method="post" id="editRoleForm" enctype="multipart/form-data">
            <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text"
                        class="form-control"
                        id="name"
                        name ="name"
                        placeholder="Input role name..."
                        value="{{ $roleEdit->name }}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text"
                        class="form-control"
                        name="display_name" id="display_name"
                        placeholder="Input description..."
                        value="{{  $roleEdit->display_name }}">
                    </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 all">
                        <label>
                            <input type="checkbox" value="" class="check_all">
                            Choose all
                        </label>
                    </div>
                    @foreach($permissionList as $permissionItem)
                        <div class="card border-info mb-3 col-md-12">
                            <div class="card-header">
                                <label>
                                    <input {{ $permissionEdit->contains('parent_id', $permissionItem->id) ? 'checked' : 'unchecked' }} type="checkbox" value="" class="checkbox_wrapper">
                                    {{ $permissionItem->display_name }}
                                </label>
                            </div>
                            <div class="row" id="checkbox_item">
                                @foreach($permissionItem->getPermissionChildren as $permissionChildrenItem)
                                    <div class="card-body text-info col-md-6" >
                                        <h5 class="card-title">
                                            <label>
                                                <input {{ $permissionEdit->contains('id', $permissionChildrenItem->id) ? 'checked' : 'unchecked' }} type="checkbox" name="permission_id[]"  class="checkbox_children" value="{{ $permissionChildrenItem->id }}">
                                            </label>
                                            {{ $permissionChildrenItem->display_name }}
                                        </h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            </form>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
@endsection
