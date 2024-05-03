@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List</h1>
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
                                <h3 class="card-title">All Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th></th>
                                            <th>Student Name</th>
                                            <th>Roll No</th>
                                            <th>Class</th>
                                            <th>DOB</th>
                                            <th>Contact No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody" id="tbody">
                                        @foreach ($students as $student)
                                        @php
                                            $role = $student->role;
                                        @endphp
                                            @if($role == 3)
                                            <tr>
                                                <td><span id=""></span>{{ $loop->index + 1 }}</td>
                                                <td><span id="studentImage{{ $student->id }}"><img
                                                            src="{{ $student->student_image }}" alt="student_image"
                                                            style="width: 30px; height:30px; border-radius:50px;"></span>
                                                </td>
                                                <td><span id="studentname{{ $student->id }}">{{ $student->name }}</span>
                                                </td>
                                                <td><span id="rollno {{ $student->id }}">{{ $student->student_roll_no }}</span>
                                                </td>
                                                    <td>
                                                        @foreach ($classes as $class)
                                                            @if($class->id == $student->student_class_id)
                                                            {{ $class->className }}
                                                                {{-- <span id="class {{ $student->student_class_id == $class->id}}"></span> --}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @php
                                                    $date_of_birth = date('d-m-Y', strtotime($student->date_of_birth));
                                                @endphp
                                                <td><span id="dob{{ $student->id }}">{{ $date_of_birth }}</span></td>
                                                <td><span id="mobile{{ $student->id }}">{{ $student->mobile_no }}</span>
                                                </td>
                                                <td><span id="mobile {{ $student->status }}">{{ $student->status }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', [Crypt::encrypt($student->id)]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('admin.student.delete', ['id' => Crypt::encrypt($student->id)]) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endif
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
