@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="javascript:void(0)" class="btn btn-primary mb-2" id="createNewCategory">Create Gallery Category</a>
                <br>
                <table class="table table-bordered table-striped-col data-table" width="100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="uploadForm" action="javascript:void(0)" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="category" placeholder="Enter Category" id="category" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" class="form-control">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                dataSrc: "",
                ajax: "",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data:'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNewCategory').click(function () {
                $('#saveBtn').val("Add");
                $('#product_id').val('');
                $('#uploadForm').trigger("reset");
                $('#modelHeading').html("Add New Image");
                $('#ajaxModel').modal('show');
            });

            $('#uploadForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('albumcategory.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        // alert('File has been uploaded successfully');
                        // console.log(data);
                        $('#uploadForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });


            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('albumcategory.store') }}"+'/'+product_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection