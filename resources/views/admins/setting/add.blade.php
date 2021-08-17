@extends('layouts.admin')

@section('title')
    <title>Add setting</title>
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header',['name' => 'Setting', 'key' => 'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('setting.store') . '?type=' . request()->type }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text" class="form-control  @error('config_key') is-invalid @enderror" name="config_key" placeholder="Input config key...">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if (request()->type=='Text')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Input config value...">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @elseif (request()->type=='Textarea')
                                    <div class="form-group">
                                        <label>Config value</label>
                                        <textarea type="text" class="form-control  @error('config_value') is-invalid @enderror" name="config_value" placeholder="Input config value..." row="8"></textarea>
                                        @error('config_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                            @endif


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
