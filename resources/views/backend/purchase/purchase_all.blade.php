@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Purchase</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Purchase</li>
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
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary radius-30">
                        <i class="bx bxs-plus-square"></i> Add Purchase
                </a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th width="10%">Purchase No</th>
                            <th>Purchase Date</th>
                            <th>Product Name</th>
                            <th>Supplier Name</th>
                            <th>Purchase Details</th>
                            {{-- <th>Category</th> --}}
                            <th>Qty</th>
                            <th>Purchase Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td class="text-center" style="word-wrap: break-word; min-width:120px; max-width:200px; white-space:normal;">#{{ $item->purchase_no }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($item->purchase_date)) }}</td>
                                <td style="word-wrap: break-word; min-width:120px; max-width:200px; white-space:normal;">{{ $item['product']['product_name'] }}</td>
                                <td class="text-center">{{ $item['supplier']['supplier_name'] }}</td>
                                {{-- <td class="text-center">{{ $item['category']['category_name'] }}</td> --}}
                                <td class="text-center" style="word-wrap: break-word; min-width:120px; max-width:200px; white-space:normal;">{{ $item->p_description }}</td>
                                <td class="text-center">{{ $item->buying_qty }}</td>
                                <td class="text-center">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-center">
                                     @if ($item->status == "0")
                                        <span class="badge rounded-pill bg-light-warning text-warning w-100">Pending</span>
                                     @elseif($item->status == "1")
                                        <span class="badge rounded-pill bg-light-success text-success w-100">Approved</span>
                                     @endif
                                </td>
                                <td>

                                    @if($item->status == "0")
                                        <button class="btn btn-sm btn-danger deletePurchase" data-url="{{ route('purchase.delete', $item->id) }}">
                                            <i class="lni lni-trash"></i>Trash
                                        </button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN</th>
                            <th width="10%">Purchase No</th>
                            <th>Purchase Date</th>
                            <th>Product Name</th>
                            <th>Supplier Name</th>
                            <th>Purchase Details</th>
                            {{-- <th>Category</th> --}}
                            <th>Qty</th>
                            <th>Purchase Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.deletePurchase').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the purchase items!",
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


