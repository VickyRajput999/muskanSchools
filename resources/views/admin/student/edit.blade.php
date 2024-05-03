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
                                <h3 class="card-title">Edit Student Profile</h3>
                            </div>
                            <form id="enroll_student" name="enroll_student" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <input type="text" hidden name="id" id="id" value="{{ $students->id }}">
                                            <label for="">First Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $students->name }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                value="{{ $students->student_lastName }}">
                                        </div>
                                        {{-- @php
                                            $roll_number = rand(111111,999999);
                                            $admission_number = 'MSM-'.rand(1111111111,9999999999);
                                        @endphp --}}
                                        <div class="col-md-3 form-group">
                                            <label for="">Administion No<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="adminision_no"
                                                id="adminision_no" value="{{ $students->adminision_no }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Roll No<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="roll_no" id="roll_no"
                                                value="{{ $students->student_roll_no }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Admission Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="adminssion_date"
                                                id="adminssion_date" value="{{ $students->adminision_date }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="class">Class<span class="text-danger">*</span></label>
                                            <select name="student_class" id="student_class" class="form-control">
                                                @php
                                                    $classes = App\Models\ClassModel::where('status', '!=', 'inactive')->get();
                                                @endphp
                                                 @foreach ($classes as $class)
                                                 @if($class->id == $students->student_class_id)
                                                    <option value="{{ $class->id }}">{{ $class->className }}</option>
                                                 @endif
                                             @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Gender<span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-control">
                                                {{-- <option value="" disabled selected>Select Gender</option> --}}
                                                <option {{ $students->id == 'gender' ? 'seleted' : '' }} value="Male">Male</option>
                                                <option {{ $students->id == 'gender' ? 'seleted' : '' }} value="Female">Female</option>
                                                <option {{ $students->id == 'gender' ? 'seleted' : '' }} value="Female">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="">Date of Birth<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="student_dob" id="student_dob"
                                                value="{{ $students->date_of_birth }}">
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="caste">Caste<span class="text-danger">*</span></label>
                                            <select name="caste" id="caste" class="form-control">
                                                {{-- <option value="" disabled selected>Select Caste</option> --}}
                                                <option {{$students->id == 'student_caste' ? 'selected' : '' }} value="General">General</option>
                                                <option {{$students->id == 'student_caste' ? 'selected' : '' }} value="OBC">OBC</option>
                                                <option {{$students->id == 'student_caste' ? 'selected' : '' }} value="SC">SC</option>
                                                <option {{$students->id == 'student_caste' ? 'selected' : '' }} value="ST">ST</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Religion<span class="text-danger">*</span></label>
                                            <select name="Religion" id="Religion" class="form-control">
                                                <option {{ $students->id == 'student_religion' ? 'selected' : '' }}value="Hindu">Hindu</option>
                                                <option {{ $students->id == 'student_religion' ? 'selected' : '' }}value="Muslim">Muslim</option>
                                                <option {{ $students->id == 'student_religion' ? 'selected' : '' }}value="Sikh">Sikh</option>
                                                <option {{ $students->id == 'student_religion' ? 'selected' : '' }}value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Mobile No<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="student_mobile"
                                                id="student_mobile" value="{{ $students->mobile_no }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Upload Image<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="student_image" id="student_image">
                                            <!-- Display the existing student image if available -->
                                            @if ($students->student_image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($students->student_image) }}" alt="Student Image" class="img-thumbnail" style="max-width: 100px;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="">Blood Group<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="student_blood_group"
                                                id="student_blood_group" value="{{ $students->student_blood_group }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Email Id<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email"
                                                id="email" value="{{ $students->email }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password"
                                                id="password" value="{{ $students->password }}">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="">Status<span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="" disabled selected>Select Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
            $('#enroll_student').validate({
                validClass: 'success',
                errorClass: 'invalid',
                rules: {
                    name: {
                        required: true
                    },
                    adminision_no: {
                        required: true
                    },
                    roll_no: {
                        required: true
                    },
                    adminssion_date: {
                        required: true,
                        date: true
                    },
                    student_class: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    student_dob: {
                        required: true,
                        date: true
                    },
                    caste: {
                        required: true
                    },
                    Religion: {
                        required: true
                    },
                    student_mobile: {
                        required: true,
                        digits: true,
                        rangelength: [10, 10]
                    },
                    student_image: {
                        required: true,
                        // extension: "jpg|jpeg|png|gif"
                    },
                    student_blood_group: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 8
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Enter your first name."
                    },
                    adminision_no: {
                        required: "Enter admission number."
                    },
                    roll_no: {
                        required: "Enter roll number."
                    },
                    adminssion_date: {
                        required: "Enter admission date.",
                        date: "Enter a valid date format."
                    },
                    student_class: {
                        required: "Enter student class."
                    },
                    gender: {
                        required: "Enter gender."
                    },
                    student_dob: {
                        required: "Enter date of birth.",
                        date: "Enter a valid date format."
                    },
                    caste: {
                        required: "Enter caste."
                    },
                    Religion: {
                        required: "Enter religion."
                    },
                    student_mobile: {
                        required: "Enter mobile number.",
                        digits: "Enter a valid number.",
                        rangelength: "Mobile number must be 10 digits."
                    },
                    student_image: {
                        required: "Upload an image.",
                        // extension: "Upload an image in jpg, jpeg, png, or gif format."
                    },
                    student_blood_group: {
                        required: "Enter blood group."
                    },
                    email: {
                        required: "Enter email.",
                        email: "Enter a valid email address."
                    },
                    password: {
                        required: "Enter password.",
                        minlength: "Password must be at least 6 characters long.",
                        maxlength: "Password must not exceed 8 characters."
                    },
                    status: {
                        required: "Enter status."
                    }
                },
                element: 'p',
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                    error.css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'font-size': '13px'
                    });
                }
            });

            $(document).on('submit', '#enroll_student', function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    let formData = new FormData($(this)[0]);
                    $('button[type=submit]').prop('disabled', true);

                    $.ajax({
                        url: "{{ route('admin.student.update') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            $('button[type=submit]').prop('disabled', false);
                            if (res.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Student Record Created Successfully',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    window.location.href =
                                        "{{ route('admin.student') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Student Record No Created. Please try again later.',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                    });
                }
            });
        });
    </script>
@endsection
