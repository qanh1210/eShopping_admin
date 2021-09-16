@extends('layouts.admin')

@section('title')
    <title>Add category</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header',['route' => route('categories.index'),'name' => 'Add', 'key' => 'Category']);

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Input category name...">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose parent category</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0" disabled>Choose parent category</option>
                                    {!! $htmlOptions !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text"
                                       class="form-control"
                                       name ="slug"
                                       placeholder="Input slug...">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <br>
                                <a href="#new_parent_category_modal" data-target="#new_parent_category_modal" data-toggle="modal" >
                                    {{ __('Create a new parent category?') }}
                                </a>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('modal.new_parent_category')
@endsection
