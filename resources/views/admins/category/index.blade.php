@extends('layouts.admin')

@section('title')
    <title>List of categories</title>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
    @cannot('edit-category')
        <script>
            $(function () {
                $('.action-edit').on('click', function (e) {
                    $('#access_modal').modal('show');
                    e.preventDefault();
                });
            });
        </script>
    @endcannot
    @cannot('add-category')
        <script>
            $(function () {
                $('.action-add').on('click', function (e) {
                    $('#access_modal').modal('show');
                    e.preventDefault();
                });
            });
        </script>
    @endcannot
    @cannot('delete-category')
        <script>
            $(function () {
                $('.action-delete').on('click', function (e) {
                    $('#access_modal').modal('show');
                    e.preventDefault();
                });
            });
        </script>
    @endcannot

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header',['route' => route('categories.index'),'name' => 'Categories', 'key' => 'List of'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2 action-add">
                            Add a category</a>
                    </div>
                    <div class="col-md-12">
                        <div id="table-data">
                            @include('admins.category.list')
                        </div>
                    </div>
                    <!-- /.col-md-12 -->

                </div>
                <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('modal.access-denied')
@endsection
