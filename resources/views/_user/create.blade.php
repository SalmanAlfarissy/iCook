@extends('layouts.main')
@section('title','iCook : Resep Masakan')
@section('page-title','User')

@section('breadcrump')
<div class="row page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="/">Home</a></li>
        <li class="breadcrumb-item active"><a href="/user">User</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Create</a></li>
    </ol>
</div>
@endsection
@section('content')
@if (Session::get('message'))
    <div class="alert alert-warning alert-dismissible alert-alt fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
        <strong>Warning!</strong> {{ Session::get('message') }}
    </div>
@endif

<div class="card">

    <div class="card-header">
        <h4 class="card-title">Form Create</h4>
    </div>
    <div class="card-body">
        <div class="basic-form">
            <form action="/user/store" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
