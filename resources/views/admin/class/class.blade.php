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
                            <a href="{{ route('admin.addClass') }}" class="btn btn-primary">Add New Class</a>
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
                                <h3 class="card-title">All Class</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Class Name</th>
                                            <th>Status</th>
                                            <th>Created_By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody" id="tbody">
                                        @foreach ($classes as $class)
                                            {{-- @php
                                                $role = $user->role;
                                            @endphp --}}
                                          <tr>
                                                <td><span id=""></span>{{ $loop->index + 1 }}</td>
                                                <td><span id="name{{ $class->id }}">{{ $class->className }}</span></td>
                                                <td>
                                                    @if($class->status == 'Active')
                                                        <span id="status{{ $class->id }}">{{$class->status }}</span>
                                                    @else
                                                        <span id="status{{ $class->id }}">{{$class->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($class->created_by == 1)
                                                        <span id="role{{ $class->id }}">Admin</span>
                                                    @else
                                                        <span id="role{{ $class->id }}">Teacher</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.edit', [Crypt::encrypt($class->id)]) }}
                                                        " class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.class.delete', ['id' => Crypt::encrypt($class->id)]) }}" class="btn btn-danger">Delete</a>

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
