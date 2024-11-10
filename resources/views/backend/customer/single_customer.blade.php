@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Customer Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Customer</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="form-body">
                            <div class="p-2 text-center">
                                <img src="{{ (!empty($customer->c_image))? url('upload/customer/'.$customer->c_image): url('upload/No_Image.jpg') }}" width="150" height="150" class="rounded-circle p-1 bg-primary shadow" alt="{{ $customer->customer_name }}">
                                <h2 class="mb-0 mt-5 text-primary">{{ $customer->customer_name }}</h2>
                                <p class="mb-3 lead">{{ $customer->c_email }}</p>
                            </div>
                            <table class="table table-boarderd my-4">
                                <tr>
                                    <th>#SN</th>
                                    <td>:</td>
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Name</th>
                                    <td>:</td>
                                    <td>{{ $customer->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td>:</td>
                                    <td>{{ $customer->c_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $customer->c_email }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>:</td>
                                    <td>{{ $customer->c_gender }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>:</td>
                                    <td>{{ $customer->c_dob }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        @if ($customer->status == "1")
                                        <span class="badge bg-success">Active</span>
                                        @else
                                           <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>:</td>
                                    <td width="65%">{{ $customer->address }}</td>
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


