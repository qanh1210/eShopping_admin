@extends('layouts.admin')

@section('title')
    <title>Add user</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['route' => route('users.index'),'name' => 'User', 'key' => 'Edit'])

    <!-- Main content -->
    <form action="{{ route('users.update',['id'=> $userEdit->id]) }}" method="post" id="editUserForm" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text"
                        class="form-control"
                        id="name"
                        name ="name"
                        placeholder="Input user name..."
                        value="{{ $userEdit->name }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text"
                        class="form-control"
                        name="email" id="email"
                        placeholder="Input email..."
                        value="{{  $userEdit->email }}">
                    </div>


                    <div class="form-group">
                      <label>Choose role</label>
                      <select class="form-control select2_init" name="role_id[]" id="role_id" multiple>
                        <option value=""></option>
                        @foreach ($roles as $role)
                            <option
                            {{ $roleUserEdit->contains('id', $role->id) ? 'selected' : '' }}
                            value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
            </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('js')
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
@endsection
