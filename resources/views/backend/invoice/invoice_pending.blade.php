@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pending Invoice List</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Invoice</li>
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
                    <a href="{{ route('invoice.add') }}" class="btn btn-primary radius-30">
                        <i class="bx bxs-plus-square"></i> Add Invoice
                </a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="7%">Date</th>
                            <th width="7%">Invoice No</th>
                            <th width="25%">Customer Name</th>
                            <th width="8%">Amount</th>
                            <th width="25%">Description</th>
                            <th width="5%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td class="text-center">#{{ $item->invoice_no }}</td>
                                <td>{{ $item['payment']['customer']['customer_name'] }}</td>
                                <td class="text-center">{{  number_format($item['payment']['total_amount'], 2) }}</td>
                                <td style="word-wrap: break-word; min-width:200px; max-width:200px; white-space:normal;">{{ $item->description }}</td>
                                <td class="text-center">
                                    @if ($item->status == "0")
                                    <div class="d-flex align-items-center bg-light-primary text-primary rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Processing</span>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == "0")
                                        <button class="btn btn-sm btn-success approveProcessing" data-url="{{ route('invoice.approve', $item->id) }}">
                                            <i class="lni lni-checkmark-circle"></i> Approve
                                        </button>
                                        
                                        <button class="btn btn-sm btn-danger deleteInvoice" data-url="{{ route('invoice.destroy', $item->id) }}">
                                            <i class="lni lni-trash"></i> Trash
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN</th>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Description</th>
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

    // Approve Processing
    document.querySelectorAll('.approveProcessing').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to approve the invoice items!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#17a00e",
                cancelButtonColor: "#f41127",
                confirmButtonText: "Approve it!",
                cancelButtonText: 'Cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete URL
                    window.location.href = deleteUrl;
                }
            });

        });
    });

    // Delete Invoice
    document.querySelectorAll('.deleteInvoice').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the invoice items!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#f41127",
                confirmButtonText: "Delete it!",
                cancelButtonText: 'Cancel!',
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


