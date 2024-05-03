<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<style>
    body {
      /* background-image: url('/admin-assets/dist/img/schoolImage.jpg'); */
      background-size: cover;
      background-position: center;
    }

    .login-box .card {
        background-color: #ffffff69;
    }
  </style>


<body class="hold-transition login-page" >

<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body "> <!-- removed the class="login-card-body" -->
        <div class="login-logo">
            <h2>Student Login</h2>
          </div>
      <p class="login-box-msg">Sign in to start your session</p>

      <form name="loginForm" id="loginForm">
        @csrf
        <div class="input-group mb-3">
          <input type="email"  name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
            <div class="error"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('auth.fogetpassword') }}">I forgot my password</a>
      </p>
      {{-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-assets/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if (session('success'))
    toastr.success('{{ session("success") }}', 'Success', {timeOut: 5000})
    @endif

    @if (session('error'))
    toastr.error('{{ session("error") }}', 'Error', {timeOut: 5000})
    @endif
</script>
<script>
   $(document).ready(function(){
    $("#loginForm").validate({
        errorClass: "invalid",
        validClass: 'success',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 8
            }
        },
        messages: {
            email: {
                required: "Enter Your Email",
                email: "Enter a Valid Email Address"
            },
            password: {
                required: "Enter a Valid Password",
                minlength: "Enter at Least 6 Characters",
                maxlength: "Enter at Most 8 Characters"
            }
        },
        element: "p",
        errorPlacement: function(error, element) {
            error.appendTo(element.parent(".input-group")); // Append error message to the parent of the input element
        }
    });

    $(document).on("submit","#loginForm",function(e){
        e.preventDefault();
        if($(this).valid()){
            let form = $(this).serializeArray();

            $('button[type=submit]').prop('disabled',true);

            $.ajax({
                url : "{{ route('AuthLogin.studentlogin') }}",
                type : "POST",
                data : form,
                dataType : 'json',
                success : function(res){
                    $('button[type=submit]').prop('disabled',false);

                    if(res.status == 'success'){
                        $.LoadingOverlay("show");
                        // Redirect to the dashboard page
                        window.location.href = res.redirect;
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    $('button[type=submit]').prop('disabled',false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while logging in. Please try again later.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    // alert("An error occurred while logging in. Please try again later.");
                    console.error(xhr.responseText); // Log detailed error message
                }
            });
        } else {
            alert("Please fill in all required fields."); // Form validation failed
        }
    });
});



</script>
</body>
</html>
