@extends('backend.master')

@section('main-content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
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
                        <h5 class="mb-0 text-dark">Edit Category</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="CategoryForm" action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="cat_name" id="cat_name"
                                value="{{ $category->category_name }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="cat_desc" class="form-label">Category Description</label>
                            <textarea cols="30" rows="2" class="form-control" name="cat_desc" id="cat_desc">{{ $category->category_des }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-dark px-5" id="save_category">Update Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
