@extends('layouts.admin')

@section('title')
    <title>Add slider</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/slider/add/add.css') }}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['route' => route('slider.index'),'name' => 'Add', 'key' => 'Slider'])

    <!-- Main content -->
    <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                      <label>Slider Name</label>
                      <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="exampleInputEmail1"
                        name ="name"
                        placeholder="Input slider name..."
                        value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file"
                        class="form-control-file @error('image_path') is-invalid @enderror"
                        name="image_path"
                        value="">
                        @error('image_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control my-editor @error('description') is-invalid @enderror " rows="8" name="description"  placeholder="Description...">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>


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
<script src="{{ asset('admin/product/add/add.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
