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
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <form id="change_password" class="change_password">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="old">Old Password</label>
                                        <input type="password" class="form-control" name="oldpassword" id="oldpassword"
                                            placeholder="Enter Old Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password"
                                            placeholder="Enter New Password">
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
        $("#change_password").validate({
            errorClass: 'invalid',
            validClass: 'success',
            rules: {
                oldpassword: {
                    required: true,
                    minlength : 6,
                    maxlength : 8
                },
                new_password:{
                    required: true,
                    minlength : 6,
                    maxlength : 8
                }
            },
            messages: {
                oldpassword: {
                    required: "Enter Old Password",
                    minlength : "Enter Minimum 6 Character",
                    maxlength : "Enter Maximum 8 Character"
                },
                new_password:{
                    required: "Enter New Password",
                    minlength : "Enter Minimum 6 Character",
                    maxlength : "Enter Maximum 8 Character"
                },
                element: 'p',
                elementPlacement: function(error, element) {
                    error.appendTo(element.parent('.form-group'));
                }
            }
        });

    $(document).on("submit", "#change_password", function(e){
        e.preventDefault();
        if($(this).valid()) {
            let data = $(this).serialize();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.change_password.changePassword') }}",
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
                            text: 'Password Change Successfully',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        // }).then((result) => {
                        //     window.location.href="{{ route('admin.class') }}";
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Password Not Changed. Please try again later.',
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
