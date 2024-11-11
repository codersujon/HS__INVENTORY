@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Invoice</div>
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
                            <th width="8%">Date</th>
                            <th width="10%">Invoice No</th>
                            <th width="20%">Customer Name</th>
                            <th width="8%">Amount</th>
                            <th>Address</th>
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
                                <td>

                                    @if($item->status == "0")
                                        {{-- <span class="badge rounded-pill bg-light-primary text-primary w-100">Processing</span> --}}
                                        <div class="d-flex align-items-center bg-light-primary text-primary rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Processing</span>
                                        </div>
                                    @elseif($item->status == "1")
                                        {{-- <span class="badge rounded-pill bg-light-info text-info w-100">On Delivery</span> --}}
                                        <div class="d-flex align-items-center bg-light-info text-info rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>On Delivery</span>
                                        </div>
                                    @elseif($item->status == "2")
                                        <div class="d-flex align-items-center bg-light-success text-success rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Delivered</span>
                                        </div>
                                    @elseif($item->status == "3")
                                        <div class="d-flex align-items-center bg-light-danger text-danger rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Returned</span>
                                        </div>
                                    @endif

                                </td>
                                <td>
                                    @if($item->status == "0")
                                        <button class="btn btn-sm btn-danger deleteInvoice" data-url="{{ route('invoice.destroy', $item->id) }}">
                                            <i class="lni lni-trash"></i>Trash
                                        </button>
                                    {{-- @elseif($item->status == "1")
                                        <a href="{{ route('invoice.deliver', $item->id) }}" class="btn btn-sm btn-success">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </a> --}}
                                    @elseif($item->status == "2")
                                        <a href="{{ route('invoice.details', $item->id) }}" class="btn btn-sm bg-primary text-white">
                                            <i class="lni lni-eye"></i> Details
                                        </a>
                                        <a href="{{ route('invoice.print', $item->id) }}" target="_blank" class="btn btn-sm bg-info text-white">
                                            <i class="fadeIn animated bx bx-printer"></i> Print
                                        </a>
                                    @endif

                                    {{-- <a href="{{ route('invoice.details', $item->id) }}" class="btn btn-sm bg-danger text-white">PDF</a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="8%">Date</th>
                            <th width="10%">Invoice No</th>
                            <th width="20%">Customer Name</th>
                            <th width="8%">Amount</th>
                            <th>Address</th>
                            <th width="5%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.deleteInvoice').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the invoice!",
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


