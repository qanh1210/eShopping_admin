@extends('layouts.admin')

@section('title')
    <title>Edit slider</title>
@endsection

@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/slider/add/add.css') }}" rel="stylesheet"/>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['route' => route('slider.index'),'name' => 'Edit', 'key' => 'Slider'])

    <!-- Main content -->
        <form action="{{ route('slider.update',['id' => $sliderEdit->id]) }}" method="post"
              enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Slider Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ $sliderEdit->name }}"
                                       placeholder="Input slider name...">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slogan</label>
                                <input type="text"
                                       class="form-control @error('slogan') is-invalid @enderror"
                                       name="slogan"
                                       value="{{ $sliderEdit->slogan }}"
                                       placeholder="Input slogan..."
                                @error('slogan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Feture Images</label>
                                <input type="file"
                                       class="form-control-file @error('image_path') is-invalid @enderror"
                                       name="image_path"
                                       id="image_path"
                                       onchange="loadImg()"
                                >
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-md-12">
                                    <div class="row">
                                        <img src="{{ $sliderEdit->image_path }}" id="image"
                                             style="max-width: 100px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror "
                                              rows="15" name="description"
                                              placeholder="Description...">{{ $sliderEdit->description }}</textarea>
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
    <script src="{{ asset('admin/slider/edit/edit.js') }}"></script>
{{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
@endsection
