@extends('layouts.main')
@section('title','iCook : Resep Masakan')
@section('page-title','Trash')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Trash</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row">
        <div class="col-md-8"><h4 class="card-title">Table Trash</h4></div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-responsive-sm" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category Name</th>
                        <th>Content</th>
                        <th>Create_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<form class="csrf">
    @csrf
</form>


@endsection

@push('custom-script')

<script>

    $(function(){
        readData();
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "/recipe/getDataTrash",
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
                    "data":result.data,
                    "columns":[
                        {"data":"no"},
                        {"data":"category.name"},
                        {"data":"title"},
                        {"data":"content"},
                        {"data":"created_at"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":5,
                            "data":"id",
                            "render":function(data, type, row){
                                return '<div class="btn-group mb-1">'+
                                    '<button type="button" class="btn btn-primary">Action</button>'+
                                    '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">'+
                                    '</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<button class="dropdown-item btn-restore" data-id="'+row.id+'">Restor</button>'+
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


    $(document).on('click', '.btn-restore', function(e){
        e.preventDefault();

        if(confirm('Apakah kamu ingin restore data ini?')){
            var inputToken = $('.csrf');
            $.ajax({
                url : "/recipe/restoreData/"+$(this).data('id'),
                type : 'POST',
                data : {
                    _token: inputToken.find("input[name=_token]").val(),
                }
            }).done(function(result){
                inputToken.find("input[name=_token]").val(result.newToken);
                if(result.status){
                    readData();
                }else{
                    alert(result.message);
                }

            }).fail(function(xhr, error){
                console.log(xhr);
                console.log(error);
            });
        }

    })
    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();

        if(confirm('Apakah kamu ingin menghapus data ini?')){
            var inputToken = $('.csrf');
            $.ajax({
                url : "/recipe/deleteTrash/"+$(this).data('id'),
                type : 'POST',
                data : {
                    _token: inputToken.find("input[name=_token]").val(),
                }
            }).done(function(result){
                inputToken.find("input[name=_token]").val(result.newToken);
                if(result.status){
                    readData();
                }else{
                    alert(result.message);
                }

            }).fail(function(xhr, error){
                console.log(xhr);
                console.log(error);
            });
        }

    })




</script>

@endpush
