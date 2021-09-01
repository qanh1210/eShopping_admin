@extends('layouts.admin')

@section('title')
    <title>Manage Setting</title>
@endsection

@section('css')
<link href="{{ asset('admin/setting/list/list.css') }}" rel="stylesheet" />
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header',['route' => route('setting.index'),'name' => 'Setting', 'key' => 'List of'])
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Add setting
                            </button>
                            <div class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('setting.create') . '?type=Text' }}">Text</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('setting.create') . '?type=Textarea' }}">Textarea</a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Config key</th>
                                    <th scope="col">Config value</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->config_key }}</td>
                                        <td>{{ $item->config_value }}</td>
                                        <td>
                                            <a href="{{ route('setting.edit', ['id' => $item->id]) . '?type=' . $item->type  }}"
                                                class="btn btn-default">Edit</a>
                                            <a href="" data-url="{{ route('setting.delete', ['id' => $item->id]) }}"
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
