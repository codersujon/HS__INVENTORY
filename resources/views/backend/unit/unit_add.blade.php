@extends('backend.master')

@section('main-content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Unit</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Unit</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-7">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Add Unit</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="unitForm" action="{{ route('unit.store') }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="unit_name" class="form-label">Unit Name</label>
                            <input type="text" class="form-control" name="unit_name" id="unit_name"
                                placeholder="Enter Unit Name">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5" id="save_unit">Save Unit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
