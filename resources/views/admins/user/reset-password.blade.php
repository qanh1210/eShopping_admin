@extends('layouts.admin')

@section('title')
    <title>Reset password</title>
@endsection

@section('css')
    <link href="{{ asset('admin/product/add/add.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->

        @include('partials.content-header',['route' => route('users.index'),'name' => 'User', 'key' => 'Reset Password'])
        <form action="{{ route('users.reset-password',['id'=> $user->id]) }}" id="changePasswordForm" method="post"
              enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            {{--                    <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                            </div>


                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                       name="confirm_password">
                                <span class="text-danger">
                                    <strong id="confirm-password-error"></strong>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary" id="change">Save</button>
                        </div>


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
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
@endsection
