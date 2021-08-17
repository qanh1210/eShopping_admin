@extends('layouts.admin')

@section('title')
    <title>Edit product</title>
@endsection

@section('css')
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['name' => 'Edit', 'key' => 'Product'])

    <!-- Main content -->
    <form action="{{ route('product.update',['id' => $productEdit->id]) }}" method="post" enctype="multipart/form-data">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                    @csrf
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        name ="name"
                        value="{{ $productEdit->name }}"
                        placeholder="Input product name...">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text"
                          class="form-control"
                          name ="price"
                          value="{{ $productEdit->price }}"
                          placeholder="Input product price...">
                    </div>

                    <div class="form-group">
                        <label>Feture Images</label>
                        <input type="file"
                        class="form-control-file"
                        name="feature_image"
                        id="feature_image"
                        >
                        <div class="col-md-12" >
                            <div class="row">
                                <img src="{{ $productEdit->feature_image_path }}" id="image" style="max-width: 100px">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Detail Images</label>
                        <input type="file"
                        class="form-control-file"
                        name="image_path[]"
                        id="image_path"
                        value="{{ $productEdit->image_name }}"
                        multiple
                        >
                        <div class="col-md-12" class="gallery">
                            <div class="row">
                                @foreach ($productEdit->images as $item)
                                    <div class="col-md-3">
                                        <img src="{{ $item->image_path }}" style="max-width: 100px">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose category</label>
                        <select class="form-control select2_init" name="category_id">
                          <option value="" disabled>Choose category</option>
                            {!! $htmlOptions !!}
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose tags</label>
                        <select class="form-control tags_select_choose" name="tags[]" value="" multiple="multiple">
                            @foreach ($productEdit->tags as $item)
                                <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control my-editor" rows="15" name="contents" id="content" placeholder="Content...">{{ $productEdit->content }}</textarea>
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
<script src="{{ asset('admin/product/edit/edit.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
