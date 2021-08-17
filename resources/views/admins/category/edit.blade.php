@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['name' => 'Category', 'key' => 'Edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('categories.update',['id' => $category->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        name ="name"
                        value="{{ $category->name }}"
                        placeholder="Input category name...">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose category</label>
                        <select class="form-control" name="parent_id">
                          <option value="0" disabled>Choose parent category</option>
                            {!! $htmlOptions !!}
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
