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
                                <h3 class="card-title"><b>Edit Profile</b></h3>
                            </div>
                            <form id="userForm" class="userForm">
                                {{-- @csrf --}}
                                <div class="card-body p-4">
                                    <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="fname">Name</label>
                                        <input type="text" hidden id="id" name="id" value="{{ Crypt::encrypt($user->id) }}">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Name" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter email" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="roles" id="roles">
                                            <option value="all">Select Role</option>
                                            <option value="1" {{ $user->role == '1' ? 'selected' : ''  }}>Admin</option>
                                            <option value="2" {{ $user->role == '2' ? 'selected' : ''  }}>Teacher</option>
                                            <option value="3" {{ $user->role == '3' ? 'selected' : ''  }}>Student</option>
                                            <option value="4" {{ $user->role == '4' ? 'selected' : ''  }}>Parents</option>
                                        </select>
                                    </div>
                                </div>
                                    {{-- <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox" value="{{ $user->rememvber_token }}">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div> --}}
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->

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
            errorClass : 'invalid',
            validClass : 'success',
            rules :{
                name:{
                    required : true
                },
                email : {
                    required : true,
                    email : true
                },
                roles : {
                    required : true
                },
                messages : {
                    name : {
                        required : 'Enter Your Name'
                    },
                    email :{
                        required : 'Enter Your Email',
                        email : 'Enter Your Email @domain.com'
                    },
                    roles :{
                        required : 'Select Your Role'
                    }
                },
                element : 'p',
                elementPlacement : function(error,element){
                    error.appendTo(element.parent('.form-control'));
                }
            }
        });

        $(document).on('submit', '#userForm', function(e){
    e.preventDefault();

    if($(this).valid()) {
        let formData = $(this).serialize();
        let id = $('#id').val();
        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{ route("admin.update", ["id" => ""]) }}/' + id,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(res){
                $('button[type=submit]').prop('disabled', false);

                if(res.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User Updated Successfully',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href="{{ route('admin.list') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'User Not Updated. Please try again later.',
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
