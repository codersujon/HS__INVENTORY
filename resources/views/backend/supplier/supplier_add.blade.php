@extends('backend.master')

@section('main-content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Supplier</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Supplier</li>
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
                        <h5 class="mb-0 text-primary">Add Supplier</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="supplierForm" action="{{ route('supplier.store') }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="supplierN" class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" name="supplierN" id="supplierN"
                                placeholder="Supplier Name">
                        </div>

                        <div class="form-group col-6">
                            <label for="contactP" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" name="contactP" id="contactP"
                                placeholder="Contact Person Name">
                        </div>

                        <div class="form-group col-6">
                            <label for="mobile_no" class="form-label">Mobile No</label>
                            <input type="tel" class="form-control" name="mobile_no" id="mobile_no" minlength="11"
                                maxlength="11" placeholder="Mobile Number">
                        </div>

                        <div class="form-group col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email Address">
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="City">
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" id="country" placeholder="Country">
                        </div>

                        <div class="col-md-6">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" name="website" id="website" placeholder="Website">
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="note" class="form-label">Extra Note</label>
                            <textarea name="note" id="note" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5" id="save_supplier">Save Supplier</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
