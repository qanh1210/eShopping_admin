@extends('layouts.admin')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>Your profile</title>
@endsection

@section('css')
    <link href="{{ asset('admin/user/profile.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4">
                    <img src="{{ asset('admin/profileUser.png') }}" alt="" class="img-rounded img-responsive"/>
                </div>
                <div class="col-6 col-md-4">
                    <p>
                    <h4>
                        {{ Auth::user()->name }}
                    </h4>
                    <small><cite title="Da Nang City, Viet Nam">Da Nang City, Viet Nam
                            <i class="fas fa-map-marker-alt"></i></cite></small>
                    <p>
                    <table class="table borderless">
                        <tr>
                            <td style="width:5%;"><i class="fas fa-envelope"></i></td>
                            <td> {{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td style="width:5%;"><i class="fas fa-user-cog"></i></td>
                            <td>
                                @foreach($userRole as $role)
                                    <li>
                                        {{ $role->display_name }}
                                    </li>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%;"><i class="fas fa-key"></i></td>
                            <td>
                                <button type="button" class="btn btn-warning" id="change_password">Change password
                                </button>
                            </td>
                        </tr>
                    </table>
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('modal.changepassword');
@endsection


@section('js')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
