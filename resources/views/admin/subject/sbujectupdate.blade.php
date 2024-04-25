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
                                <h3 class="card-title"><b>Edit Subject</b></h3>
                            </div>
                            <form id="updateForm" class="updateForm">
                                {{-- @csrf --}}
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="name">Subject Name</label>
                                            <input type="text" hidden id="id" name="id" value="{{ Crypt::encrypt($subject->id) }}">
                                            <input type="text" class="form-control" name="subjectname" id="subjectname" value="{{ $subject->subject_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select class="form-control" name="type" id="type">
                                                <option value="all">Select Status</option>
                                                <option value="Practical" {{ $subject->type == 'Practical' ? 'selected' : '' }}>Practical</option>
                                                <option value="Theratical" {{ $subject->type == 'Theratical' ? 'selected' : '' }}>Theratical</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="all">Select Class Name</option>
                                                <option value="Active" {{ $subject->status == 'Active' ? 'selected' : ''  }}>Active</option>
                                                <option value="Inactive" {{ $subject->status == 'Inactive' ? 'selected' : ''  }}>Inactive</option>
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
        $(document).on('submit', '#updateForm', function(e){
            e.preventDefault();
                let formData = $(this).serialize();
                let id = $('#id').val();
                $('button[type=submit]').prop('disabled', true);

                $.ajax({
                    url: '{{ route("admin.update.subject", ["id" => ""]) }}/' + id,
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
                                text: 'Subject Updated Successfully',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href="{{ route('admin.subject') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'This Subject Has Been Already Taken',
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
