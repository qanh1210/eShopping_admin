@extends('layouts.admin')

@section('title')
    <title>Add product</title>
@endsection

@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet"/>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['route' => route('product.index'),'name' => 'Add', 'key' => 'Product'])

    {{-- <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                 @endforeach
                </ul>
            </div>
        @endif
    </div> --}}
    <!-- Main content -->
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="exampleInputEmail1"
                                       name="name"
                                       placeholder="Input product name..."
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       placeholder="Input product price..."
                                       value="{{ old('price') }}">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Feture Images</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="feature_image"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label>Detail Images</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="image_path[]"
                                       value=""
                                       multiple>
                            </div>
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="exampleFormControlSelect1">Choose category</label>--}}
                            {{--                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"--}}
                            {{--                                        name="category_id">--}}
                            {{--                                    <option value="0" selected disabled>Choose category</option>--}}
                            {{--                                    {!! $htmlOptions !!}--}}
                            {{--                                </select>--}}
                            {{--                                @error('category_id')--}}
                            {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            <div class="form-group">
                                <label>Choose category</label>
                                <div class="col-md-8">
                                    @foreach($parent_categories as $parent_category_item)
                                        <div class="form-check abc">
                                            <input class="form-check-input" type="checkbox" name="parent_category"
                                                   value="{{ $parent_category_item->id }}">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{ $parent_category_item->name }}
                                            </label>
                                            <select
                                                class="form-control select2_init @error('category_id') is-invalid @enderror"
                                                name="category_id" value="{{ $parent_category_item->id }}">
                                                <option value="0" selected disabled>Choose category</option>
                                                @foreach($parent_category_item->getCategoryItem as $value)
                                                    @if($value->getCategoryItem->contains('parent_id',$value->id))
                                                        <optgroup value="{{ $value->id }}"
                                                                  label="{{ $value->name }}"></optgroup>
                                                    @else
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endif

                                                    @foreach($value->getCategoryItem as $valueItem)
                                                        <option
                                                            value="{{ $valueItem->id }}">{{ $valueItem->name }}</option>
                                                    @endforeach
                                                @endforeach

                                            </select>
                                            @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose tags</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Choose collections</label>
                                <select class="form-control tags_select_choose" name="collections[]" multiple="multiple">
                                    @foreach ($collections as $collection)
                                        <option value="{{ $collection->name }}">{{ $collection->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control @error('contents') is-invalid @enderror " rows="15"
                                          name="contents" id="content" value=""
                                          placeholder="Content...">{{ old('contents') }}</textarea>
                                @error('contents')
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

    {{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
@endsection
