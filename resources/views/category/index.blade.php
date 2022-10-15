@extends('layouts.main')
@section('title','iCook : Resep Masakan')
@section('page-title','Category')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row">
        <div class="col-md-8"><h4 class="card-title">Table Category</h4></div>
        <div class="col-md-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createModal">+ Create</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

<!-- Modal Create-->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form method="POST" class="createForm">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                    <span class="error-text text-danger name-error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-data">Save Data</button>
                </div>

        </div>
    </div>
</div>

<!-- Modal Update-->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form method="POST" class="updateForm">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                    <span class="error-text text-danger name-error"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-data">Update Data</button>
                </div>
        </div>
    </div>
</div>

@endsection

@push('custom-script')
<script>
    $(function(){
        readData();
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "/category/getData",
            data: {},
            success: function (result) {
                $('#dataTable').DataTable({
                    "ordering":true,
                    "responsive":true,
                    "destroy":true,
                    "language": {
                        "paginate": {
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                        },
                    },
                    "data":result,
                    "columns":[
                        {"data":"no"},
                        {"data":"name"},
                        {"data":"description"},
                        {"data":"created_at"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":4,
                            "data":"id",
                            "render":function(data, type, row){
                                return '<div class="btn-group mb-1">'+
                                    '<button type="button" class="btn btn-primary">Action</button>'+
                                    '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">'+
                                    '</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<button class="dropdown-item btn-edit" data-id="'+row.id+'">Edit</button>'+
                                        '<button class="dropdown-item btn-delete" data-id="'+row.id+'">Delete</button>'+
                                    '</div>'+
                                '</div>';
                            },

                        },
                    ],
                });

            },
            error: function(err){
                console.log(err);

            }
        });
    }

    $(document).on('click','.save-data', function(e){
        e.preventDefault();
        var form = $('.createForm');

        $.ajax({
            type: "POST",
            url: "/category/createData",
            data: form.serialize(),
            success: function (result) {
                $('#createModal').modal('hide');
                swal("Proses Success!!", "Data category Berhasil di Tambahkan..", "success")
                readData();
            },
            error: function(err){
                if(err.responseJSON.errors.name){
                    $(".name-error").show().text(err.responseJSON.errors.name);
                }
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        $.ajax({
            type: "GET",
            url: "/category/getData",
            data: {
                id: $(this).data('id'),
            },
            success: function (result) {
                var form = $('.updateForm');
                form.find('input[name=id]').val(result.id);
                form.find('input[name=name]').val(result.name);
                form.find('textarea[name=description]').val(result.description);
                $('#updateModal').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click','.update-data', function(e){
        e.preventDefault();
        var form = $('.updateForm');

        $.ajax({
            type: "POST",
            url: "/category/updateData/"+form.find("input[name=id]").val(),
            data: form.serialize(),
            success: function (result) {
                $('#updateModal').modal('hide');
                swal("Proses Success!!", "Data user Berhasil di Update..", "success")
                readData();
            },
            error: function(err){
                if(err.responseJSON.errors.name){
                    $(".name-error").show().text(err.responseJSON.errors.name);
                }
            }
        });
    });

    $(document).on('click','.btn-delete', function(e){
        e.preventDefault();

        if(confirm('Apakah kamu ingin menghapus data ini?')){
            var inputToken = $('input[name=_token]');
            $.ajax({
                url : "/category/deleteData/"+$(this).data('id'),
                type : 'POST',
                data : {
                    _token: inputToken.val(),
                }
            }).done(function(result){
                inputToken.val(result.newToken);
                    readData();

            }).fail(function(xhr, error){
                console.log(xhr);
                console.log(error);
            });
        }

    });

</script>
@endpush
