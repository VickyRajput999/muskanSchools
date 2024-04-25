<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <h2>Reset Password</h2>
                </div>
                <form name="resetPassword" id="resetPassword">
                    <div class="input-group mb-3">
                        <input type="text" hidden name="token"  id="token" class="form-control"
                            value="{{ $token->remember_token }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Reset Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="cpassword" id="cpassword" class="form-control"
                            placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Reset</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success', {
                timeOut: 5000
            })
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error', {
                timeOut: 5000
            })
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $("#resetPassword").validate({
                errorClass: 'invalid',
                validClass: 'success',
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 8
                    },
                    cpassword: {
                        required: true,
                        equalTo: '#password' // Use equalTo instead of same
                    }
                },
                messages: {
                    password: {
                        required: 'Enter Your New Password',
                        minlength: 'Minimum 6 Character Required',
                        maxlength: 'Maximum 8 Character Required'
                    },
                    cpassword: {
                        required: 'Enter Confirm Password',
                        equalTo: 'Confirm Password Same As Password'
                    }
                },
                element: 'p',
                elementPlacement: function(error, element) {
                    error.appendTo(element.parent('.form-control'));
                }
            });


            $(document).on("submit", "#resetPassword", function(e) {
                e.preventDefault();

                if ($(this).valid()) {
                    let data = $(this).serialize();
                    let remember_token = $('#token').val();
                    $('button[type=submit]').prop('disabled', true);

                    $.ajax({
                        url: '{{ route("auth.resetPassword", ["remember_token" => ""]) }}/' + remember_token,
                        type: 'POST',
                        data: data, // Use the serialized form data directly
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType: 'json',
                        success: function(res) {
                            $('button[type=submit]').prop('disabled', false);
                            if(res.status == 'success')
                            {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Password Reset Successful!',
                                  text: 'Your password has been successfully reset.',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'OK'
                              }).then((result) => {
                                  window.location.href="{{ route('login') }}";
                              });
                          } else {
                              // Display error message using SweetAlert if necessary
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Error!',
                                  text: 'An error occurred while resetting the password. Please try again later.',
                                  confirmButtonColor: '#d33',
                                  confirmButtonText: 'OK'
                              });
                          }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                        }
                    });
                }
            });


        });
    </script>


</body>

</html>
