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
                                <h3 class="card-title">Add User</h3>
                            </div>
                            <form id="userForm" class="userForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="roles" id="roles">
                                            <option value="all">Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Teacher</option>
                                            <option value="3">Student</option>
                                            <option value="4">Parents</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
    $(document).ready(function(){
    $("#userForm").validate({
        errorClass: 'invalid',
        validClass: 'success',
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            roles: {
                required: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 8
            },
            checkbox : {
                required : true
            }

        },
        messages: {
            name: {
                required: "Enter Your Name"
            },
            email: {
                required: "Enter Your Email",
                email: "Enter Email As @domain.com"
            },
            roles: {
                required: "Select User Roles"
            },
            password: {
                required: "Enter Your Password",
                minlength: "Password must be at least 6 characters long",
                maxlength: "Password cannot exceed 8 characters"
            },
            checkbox :{
                required : "Please Click the checkbox"
            },
            element: 'p',
            elementPlacement: function(error, element) {
                error.appendTo(element.parent('.form-group'));
            }
        }
    });

    $(document).on("submit", "#userForm", function(e){
        e.preventDefault();
        if($(this).valid()) {
            let data = $(this).serialize();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.store') }}",
                type: 'POST',
                data: data,
                // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                success: function(res) {
                    $('button[type=submit]').prop('disabled', false);

                    if(res.status == 'success')
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User Created Successfully',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            window.location.href="{{ route('admin.list') }}";
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'User No Created. Please try again later.',
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
