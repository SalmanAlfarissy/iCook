@extends('layouts.main')
@section('title','iCook : Resep Masakan')
@section('page-title','Recipe')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Recipe</a></li>
    </ol>
</div>
@endsection
@section('content')
<div class="card">

    <div class="card-header row">
        <div class="col-md-8"><h4 class="card-title">Table Recipe</h4></div>
        <div class="col-md-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createModal">+ Create</button>
            <a href="/recipe/trash" class="btn btn-warning mb-2"><i class="flaticon-089-trash"></i> Trash</a>
        </div>
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
                        <th>Image</th>
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
                <h5 class="modal-title">Create Recipe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="POST" id="createForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Title" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <select class="form-control wide" name="category_id">
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" name="content"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="form-file">
                                        <input type="file" name="gambar" class="form-file-input form-control">
                                    </div>
                                    <span class="input-group-text">Upload</span>
                                </div>
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
                <h5 class="modal-title">Update Recipe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="POST" id="updateForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Title" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <select class="form-control wide" name="category_id">
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4" id="content" name="content"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="form-file">
                                        <input type="file" name="gambar" class="form-file-input form-control">
                                    </div>
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <img src="" id="gambar" width="70" alt="">
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
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>

<script>

    $(function(){
        readData();
    });

    function readData(){
        $.ajax({
            type: "GET",
            url: "/recipe/getData",
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
                        {"data":"category.name"},
                        {"data":"title"},
                        {"data":"content"},
                        {"data":"gambar"},
                        {"data":"created_at"},
                        {"data":"id"}
                    ],
                    "columnDefs":[
                        {
                            "targets":6,
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
                        {
                            "targets":4,
                            "data":"gambar",
                            "render":function(data, type, row){
                                return '<img src="{{ asset('image/content') }}/'+data+'" width="50" alt="">';
                            },

                        },
                        {
                            "targets":3,
                            "data":"content",
                            "render":function(data, type, row){
                                return data.substring(0,200)+'...<a href="#" style="text-decoration: none; color:red;">Selanjutnya</a>';
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
        tinyMCE.triggerSave();
        let form = $('#createForm');
        let formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: "/recipe/createData",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                $('#createModal').modal('hide');
                swal("Proses Success!!", "Data category Berhasil di Tambahkan..", "success")
                readData();
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        tinyMCE.triggerSave();
        $.ajax({
            type: "GET",
            url: "/recipe/getData",
            data: {
                id: $(this).data('id'),
            },
            success: function (result) {
                var form = $('#updateForm');
                form.find('input[name=id]').val(result.id);
                form.find('input[name=title]').val(result.title);
                form.find('select[name=category_id]').val(result.category_id);
                tinymce.get('content').setContent(result.content);
                $("#gambar").attr("src", "image/content/" + result.gambar);
                $('#updateModal').modal('show');
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click','.update-data', function(e){
        e.preventDefault();
        tinyMCE.triggerSave()
        var form = $('#updateForm');
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: "/recipe/updateData/"+form.find("input[name=id]").val(),
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                $('#updateModal').modal('hide');
                swal("Proses Success!!", "Data user Berhasil di Update..", "success")
                readData();
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(document).on('click','.btn-delete', function(e){
        e.preventDefault();

        if(confirm('Apakah kamu ingin menghapus data ini?')){
            var inputToken = $('input[name=_token]');
            $.ajax({
                url : "/recipe/deleteData/"+$(this).data('id'),
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
