@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header',['route' => route('menus.index'),'name' => 'Menu', 'key' => 'Add']);

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('menus.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label>Menu Name</label>
                      <input type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        name ="name"
                        placeholder="Input menu name...">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose parent menu</label>
                        <select class="form-control" name="parent_id">
                          <option value="0" disabled>Choose parent menu</option>
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
