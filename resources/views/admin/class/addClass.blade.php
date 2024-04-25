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
                                <h3 class="card-title">Add Class</h3>
                            </div>
                            <form id="classForm" class="classForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="class">Class Name</label>
                                        <input type="text" class="form-control" name="class" id="class"
                                            placeholder="Enter Class">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="all">Select Status</option>
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
    $(document).ready(function(){
    $("#classForm").validate({
        errorClass: 'invalid',
        validClass: 'success',
        rules: {
            class: {
                required: true,
            },
        },
        messages: {
            class: {
                required: "Enter Class Name"
            },
            element: 'p',
            elementPlacement: function(error, element) {
                error.appendTo(element.parent('.form-group'));
            }
        }
    });

    $(document).on("submit", "#classForm", function(e){
        e.preventDefault();
        if($(this).valid()) {
            let data = $(this).serialize();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.insertClass') }}",
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
                            text: 'Class Created Successfully',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            window.location.href="{{ route('admin.class') }}";
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
