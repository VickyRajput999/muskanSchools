@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Enroll Student</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <a href="{{ route('admin.student.addStudent') }}" class="btn btn-primary">Enroll New Student</a>
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
                                <h3 class="card-title">All Subject List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Status</th>
                                            <th>Create By</th>
                                            <th>Create Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody class="tbody" id="tbody">
                                        @foreach ($allsubjects as $subject)
                                        @php
                                            $role = $subject->created_by;
                                        @endphp
                                            <tr>
                                                <td><span id=""></span>{{ $loop->index + 1 }}</td>
                                                <td><span id="name{{ $subject->class_id }}">{{ $subject->className }}</span></td>
                                                <td><span id="subjectname {{ $subject->subject_id }}">{{ $subject->subject_name }}</span></td>
                                                <td><span id="subjetstatus">{{ $subject->status }}</span></td>
                                                <td>
                                                    <span id="subject_createdNy{{ $subject->subject_id }}">
                                                        @switch($role)
                                                            @case(1)
                                                                    <p>Admin</p>
                                                                @break
                                                            @case(2)
                                                                    <p>Teacher</p>
                                                                @break
                                                            @default

                                                        @endswitch
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.asign.edit', [Crypt::encrypt($subject->id)]) }}
                                                        " class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.asignsubject.delete', ['id' => Crypt::encrypt($subject->id)]) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
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
