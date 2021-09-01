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
    @include('partials.content-header',['route' => route('users.index'),'name' => 'User', 'key' => 'Add'])

    <!-- Main content -->
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text"
                        class="form-control"
                        name ="name"
                        placeholder="Input user name..."
                        value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text"
                        class="form-control"
                        name="email"
                        placeholder="Input email..."
                        value="{{ old('email') }}" required>
                    </div>

                     <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                        class="form-control"
                        name="password"
                        placeholder="Input password..."
                        value="">
                    </div>

                    <div class="form-group">
                      <label>Choose role</label>
                      <select class="form-control select2_init" name="role_id[]" multiple>
                        <option value=""></option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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
<script>
   $(".select2_init").select2({
        placeholder: "Select role",
        allowClear: true
      });
</script>
@endsection
