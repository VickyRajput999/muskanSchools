@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Subject</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <a href="{{ route('admin.subject.addsubject') }}" class="btn btn-primary">Add Subject</a>
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
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Status</th>
                                            <th>Created by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody" id="tbody">
                                        @foreach ($subjects as $subject)
                                            <tr>
                                               <td><span id=""></span>{{ $loop->index + 1 }}</td>
                                                <td><span id="name{{ $subject->id }}">{{ $subject->subject_name }}</span></td>
                                                <td><span id="type{{ $subject->id }}">{{ $subject->type }}</span></td>
                                                <td><span id="status{{ $subject->id }}">{{ $subject->status }}</span></td>
                                                <td><span id="createdby{{ $subject->id }}">{{ $subject->created_By }}</span></td>
                                             <td>
                                                    <a href="{{ route('admin.subject.edit', [Crypt::encrypt($subject->id)]) }}
                                                        " class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.subjec.delete', ['id' => Crypt::encrypt($subject->id)]) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @dd($sbuject); --}}
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
