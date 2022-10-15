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
@if (Session::get('message'))
    <div class="alert alert-primary alert-dismissible alert-alt fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
        <strong>Success!</strong> {{ Session::get('message') }}
    </div>
@endif

<div class="card">

    <div class="card-header row">
        <div class="col-md-10"><h4 class="card-title">Table Category</h4></div>
        <div class="col-md-2">
            <a href="/category/create" class="btn btn-block btn-primary">+ Create</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-responsive-sm ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Create_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index=>$item )
                    <tr>
                        <th>{{ $index+1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
