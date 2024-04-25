<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forget Password</title>

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
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <div class="login-logo">
            <h2>Forget Password</h2>
          </div>
      {{-- <p class="login-box-msg">Sign in to start your session</p> --}}

      <form name="forgetPassword" id="forgetPassword">
        <div class="input-group mb-3">
          <input type="email"  name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        {{-- <div class="input-group mb-3">
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
          </div> --}}
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        {{-- </div> --}}
      </form>
      <p class="mb-1 py-2">
        <a href="{{ route('login') }}">Login</a>
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
        $("#forgetPassword").validate({
            errorClass : "invalid",
            validClass : "success",
            rules : {
                email : {
                    required : true,
                    email : true
                }
            },
            messages : {
                email : {
                    required : "Email Required",
                    email : "Enter Email domain@mail.com"
                }
            },
            element : "p",
            elementPlacement : function(error, element){
                error.appendTo(element.parent(".input-group"));
            }
        });

        $(document).on("submit","#forgetPassword",function(e){
            e.preventDefault();
            if($(this).valid()){
                let email = $("#email").val();

                $('button[type=submit]').prop('disabled',true);

                $.ajax({
                    url : "{{ route('auth.forget') }}",
                    type : "POST",
                    data : {email : email},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType : "json",
                    success : function(res){
                        $('button[type=submit]').prop('disabled',false);

                        if(res.status == 'success')
                            {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Success',
                                  text: 'Please check your email and reset your password.',
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
                    }
                });
            }
        })
    });
</script>
</body>
</html>
