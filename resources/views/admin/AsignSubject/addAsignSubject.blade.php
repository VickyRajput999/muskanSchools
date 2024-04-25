@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12 mt-5 ">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Asign Subject Class</h3>
                            </div>
                            <form id="userForm" class="userForm">
                                @csrf
                                <div class="card-body">
                                    {{-- @dd($classes) --}}
                                    <div class="form-group">
                                        <label for="class">Class Name</label>
                                        <select class="form-control" name="class_id" id="class_id">
                                            <option value="">Select Class</option>

                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->className }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select Subject Name</label>

                                        @foreach ($subjects as $subject)
                                            <div>
                                                <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}">
                                                {{ $subject->subject_name }}
                                            </div>
                                        @endforeach
                                        {{-- @dd($subject) --}}

                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('customJS')
    <script>
        $(document).ready(function() {

            // Initialize form validation
            $("#userForm").validate({
                rules: {
                    class_id: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    "subject_id[]": {
                        required: true,
                    }
                },
                messages: {
                    class_id: {
                        required: "Please select a class name."
                    },
                    status: {
                        required: "Please select a status."
                    },
                    "subject_id[]": {
                        required: "Please select at least one subject.",
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.is(":checkbox")) {
                        error.insertAfter(element.closest('div').last());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $(document).on("submit", "#userForm", function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    let data = $(this).serialize();
                    $('button[type=submit]').prop('disabled', true);

                    $.ajax({
                        url: "{{ route('admin.asignsubject.insert') }}",
                        type: 'POST',
                        data: data,
                        // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType: 'json',
                        success: function(res) {
                            $('button[type=submit]').prop('disabled', false);

                            if (res.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Subject Asign to Class Successfully',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    window.location.href = "{{ route('admin.asignSubject') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Subject No Asigned. Please try again later.',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
