@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Supplier</div>
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

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Supplier</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="18%">Supplier Name</th>
                            <th>Contact Person</th>
                            <th width="8%">Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($suppliers as $key => $supplier)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td style="word-wrap: break-word; min-width:120px; max-width:150px; white-space:normal;">{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->contact_person }}</td>
                                <td>{{ $supplier->mobile_no }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->city }}</td>
                                <td class="text-center">
                                     @if ($supplier->status == "1")
                                     <span class="badge bg-success">Active</span>
                                     @else
                                        <span class="badge bg-danger">Inactive</span>
                                     @endif
                                </td>
                                <td>
                                    <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-sm btn-primary"><i class="lni lni-eye"></i>Details</a>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Edit</a>
                                    
                                    <button class="btn btn-sm btn-danger deleteSupplier" data-url="{{ route('supplier.delete', $supplier->id) }}">
                                        <i class="lni lni-trash"></i>Trash
                                    </button>
                               
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="18%">Supplier Name</th>
                            <th>Contact Person</th>
                            <th width="8%">Mobile</th>
                            <th>Email</th>
                            <th>City</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.deleteSupplier').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the supplier!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
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


