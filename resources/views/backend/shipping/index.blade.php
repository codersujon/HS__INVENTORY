@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Shipping Method</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">General Setting</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary radius-30" data-bs-toggle="modal" data-bs-target="#ShippingChargeModal"><i class="bx bxs-plus-square"></i>Add Shipping Method</button>
                    <!-- Store Modal -->
                    <div class="modal fade" id="ShippingChargeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Shipping Method</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- shipping title -->
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="title" class="form-label">Shipping Title</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Shipping Title">
                                    </div> 
                                    <!-- shipping charge -->
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="shippingCharge" class="form-label">Shipping Charge</label>
                                        <input type="number" class="form-control" name="shippingCharge" id="shippingCharge"
                                            placeholder="Shipping Charge" value="0">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="StoreSCharge">Add Method</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Edit Modal -->
                     <div class="modal fade" id="EditShippingChargeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Shipping Method</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="sid">
                                    <!-- shipping title -->
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="title" class="form-label">Shipping Title</label>
                                        <input type="text" class="form-control" name="title" id="Etitle"
                                            placeholder="Shipping Title">
                                    </div> 
                                    <!-- shipping charge -->
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="shippingCharge" class="form-label">Shipping Charge</label>
                                        <input type="number" class="form-control" name="shippingCharge" id="EshippingCharge"
                                            placeholder="Shipping Charge">
                                    </div>
                                    <!-- status -->
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="shippingCharge" class="form-label">Shipping Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="UpdateShipping">Update Shipping Method</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#SN</th>
                            <th width="35%" class="text-center">Shipping Title</th>
                            <th width="30%" class="text-center">Shipping Charge</th>
                            <th width="15%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="shippingTableBody">

                         <!-- Data will be appended here -->

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%" class="text-center">#SN</th>
                            <th width="35%" class="text-center">Shipping Title</th>
                            <th width="30%" class="text-center">Shipping Charge</th>
                            <th width="15%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


