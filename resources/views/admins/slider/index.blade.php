@extends('layouts.admin')

@section('title')
    <title>Slider</title>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header',['route' => route('slider.index'),'name' => 'Sliders', 'key' => 'List of'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add a slider</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slogan</th>
{{--                                    <th scope="col">Description</th>--}}
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $sliderItem)
                                    <tr>
                                        <th scope="row">{{ $sliderItem->id }}</th>
                                        <td>{{ $sliderItem->name }}</td>
                                        <td>{{ $sliderItem->slogan }}</td>
{{--                                        <td>{{ $sliderItem->description }}</td>--}}
                                        <td><img src="{{ $sliderItem->image_path }}" style="max-width: 150px;" /></td>

                                        <td>
                                            <a href="{{ route('slider.edit', ['id' => $sliderItem->id]) }}"
                                                class="btn btn-default">Edit</a>
                                            <a href="" data-url="{{ route('slider.delete', ['id' => $sliderItem->id]) }}"
                                                class="btn btn-danger action-delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.col-md-12 -->
                    <div class="d-flex justify-content-center">
                        {{ $list->links() }}
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
