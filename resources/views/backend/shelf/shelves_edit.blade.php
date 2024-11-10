@extends('backend.master')

@section('main-content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Shelf</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Shelf</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-7">
            <div class="card border-top border-0 border-4 border-dark">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-dark"></i>
                        </div>
                        <h5 class="mb-0 text-dark">Edit Shelf</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="shelfForm" action="{{ route('shelves.update', $shelf->id) }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="shelf_name" class="form-label">Shelf Name</label>
                            <input type="text" class="form-control" name="shelf_name" id="shelf_name"
                                value="{{ $shelf->shelves_name }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" class="form-control" name="capacity" id="capacity"
                            value="{{ $shelf->capacity }}">
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="2" class="form-control">{{ $shelf->description }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-dark px-5" id="save_shelf">Update Shelf</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
