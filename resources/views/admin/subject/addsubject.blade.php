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
                                <h3 class="card-title">Add Subject</h3>
                            </div>
                            <form id="subjectForm" class="subjectForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="subject">Subject Name</label>
                                        <input type="text" class="form-control" name="subjectname" id="subjectname"
                                            placeholder="Enter Subject Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="all">Select Status</option>
                                            <option value="Practical">Practical</option>
                                            <option value="Theratical">Theratical</option>
                                        </select>
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
    $("#subjectForm").validate({
        errorClass: 'invalid',
        validClass: 'success',
        rules: {
            subjectname: {
                required: true,
            },
        },
        messages: {
            subjectname: {
                required: "Enter Subject Name"
            },
            element: 'p',
            elementPlacement: function(error, element) {
                error.appendTo(element.parent('.form-group'));
            }
        }
    });

    $(document).on("submit", "#subjectForm", function(e){
        e.preventDefault();
        if($(this).valid()) {
            let data = $(this).serialize();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.subject.insertSubject') }}",
                type: 'POST',
                data: data,
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
                            window.location.href="{{ route('admin.subject') }}";
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Subject Has Already Been Taken.',
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
