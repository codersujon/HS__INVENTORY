@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Customer</div>
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

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('customer.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Customer</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Customer Name</th>
                            <th width="10%">Customer Image</th>
                            <th>Mobile</th>
                            <th width="10%">Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th width="5%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($customers as $key => $customer)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td class="text-center">
                                    <img src="{{ (!empty($customer->c_image))? url('upload/customer/'. $customer->c_image): url('upload/No_Image.jpg') }}" alt="" width="100px" height="50px" class="rounded">
                                </td>
                                <td>{{ $customer->c_phone }}</td>
                                <td>{{ $customer->c_email }}</td>
                                <td class="text-center">{{ $customer->c_gender }}</td>
                                <td style="word-wrap: break-word; min-width:120px; max-width:150px; white-space:normal;">{{ $customer->address }}</td>
                                <td class="text-center">
                                     @if ($customer->status == "1")
                                     <span class="badge bg-success">Active</span>
                                     @else
                                        <span class="badge bg-danger">Inactive</span>
                                     @endif
                                </td>
                                <td>
                                    <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-sm btn-primary"><i class="lni lni-eye"></i>Details</a>
                                    <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Edit</a>

                                    <button class="btn btn-sm btn-danger deleteCustomer" data-url="{{ route('customer.delete', $customer->id) }}">
                                        <i class="lni lni-trash"></i>Trash
                                    </button>
                                </td>
                            </tr>


                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN</th>
                            <th>Customer Name</th>
                            <th>Customer Image</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.deleteCustomer').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the customer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#f41127",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete URL
                    window.location.href = deleteUrl;
                }
            });
            
        });
    });
</script>

@endsection


