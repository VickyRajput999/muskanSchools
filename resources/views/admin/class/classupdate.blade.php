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
                                <h3 class="card-title"><b>Edit Class</b></h3>
                            </div>
                            <form id="userForm" class="userForm">
                                {{-- @csrf --}}
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="fname">Class Name</label>
                                            <input type="text" hidden id="id" name="id" value="{{ Crypt::encrypt($class->id) }}">
                                            <input type="text" class="form-control" name="classname" id="classname" value="{{ $class->className }}">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="all">Select Class Name</option>
                                                <option value="Active" {{ $class->status == 'Active' ? 'selected' : ''  }}>Active</option>
                                                <option value="Inactive" {{ $class->status == 'Inactive' ? 'selected' : ''  }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
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
        $(document).on('submit', '#userForm', function(e){
            e.preventDefault();
                let formData = $(this).serialize();
                let id = $('#id').val();
                $('button[type=submit]').prop('disabled', true);

                $.ajax({
                    url: '{{ route("admin.class.update", ["id" => ""]) }}/' + id,
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
                                text: 'class Updated Successfully',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href="{{ route('admin.class') }}";
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
        });
    });
</script>
@endsection
