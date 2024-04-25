@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New User</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <a href="{{ route('admin.user') }}" class="btn btn-primary">Add User</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All User's List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody" id="tbody">
                                        @foreach ($users as $user)
                                            @php
                                                $role = $user->role;
                                            @endphp
                                            <tr>
                                                <td><span id=""></span>{{ $loop->index + 1 }}</td>
                                                <td><span id="name{{ $loop->index + 1 }}">{{ $user->name }}</span></td>
                                                <td><span id="email{{ $user->email }}">{{ $user->email }}</span></td>
                                                <td><span id="role{{ $role }}">
                                                    @switch($role)
                                                        @case(1)
                                                            <p>Admin</p>
                                                        @break

                                                        @case(2)
                                                            <p>Teacher</p>
                                                        @break

                                                        @case(3)
                                                            <p>Student</p>
                                                        @break

                                                        @case(4)
                                                            <p>Parents</p>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.edit', [Crypt::encrypt($user->id)]) }}
                                                        " class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.delete', ['id' => Crypt::encrypt($user->id)]) }}" class="btn btn-danger">Delete</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                                      <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('customJs')
@endsection
