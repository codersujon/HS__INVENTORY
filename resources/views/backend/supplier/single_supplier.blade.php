@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Supplier Details</div>
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
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="{{ route('supplier.all') }}" class="btn btn-primary radius-30"><i class="bx bxs-arrow"></i>Back</a>
                        </div>
                    </div>
                    <div class="border p-4 rounded">
                        <div class="form-body">
                            <table class="table table-boarderd">
                                <h2 class="text-center text-primary mb-3">{{ $supplier->supplier_name }} Details</h2>
                                <tr>
                                    <th>#SN</th>
                                    <td>:</td>
                                    <td>{{ $supplier->id }}</td>
                                </tr>
                                <tr>
                                    <th>Supplier Name</th>
                                    <td>:</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Person</th>
                                    <td>:</td>
                                    <td>{{ $supplier->contact_person }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td>:</td>
                                    <td>{{ $supplier->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $supplier->email }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>:</td>
                                    <td>{{ $supplier->city }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>:</td>
                                    <td>{{ $supplier->country }}</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>:</td>
                                    <td>
                                       @if (empty($supplier->website))
                                            {{ 'N/A' }}
                                        @else
                                            {{ $supplier->website }}
                                       @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if ($supplier->status == "1")
                                        <span class="badge bg-success">Active</span>
                                        @else
                                           <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>:</td>
                                    <td>{{ $supplier->address }}</td>
                                </tr>
                                <tr>
                                    <th>Extra Note</th>
                                    <td>:</td>
                                    <td>{{ $supplier->note }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


