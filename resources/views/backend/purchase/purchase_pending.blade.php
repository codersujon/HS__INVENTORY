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
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="8%">Purchase No</th>
                            <th width="8%">Purchase Date</th>
                            <th>Product Name</th>
                            <th width="10%">Supplier Name</th>
                            <th>Purchase Details</th>
                            {{-- <th width="12%">Category</th> --}}
                            <th width="5%">Qty</th>
                            <th width="8%">Purchase Price</th>
                            <th width="8%">Total Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td class="text-center">{{ $item->purchase_no }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($item->purchase_date)) }}</td>
                                <td style="word-wrap: break-word; min-width:150px; max-width:220px; white-space:normal;">{{ $item['product']['product_name'] }}</td>
                                <td class="text-center">{{ $item['supplier']['supplier_name'] }}</td>
                                {{-- <td class="text-center">{{ $item['category']['category_name'] }}</td> --}}
                                <td class="text-center" style="word-wrap: break-word; min-width:120px; max-width:200px; white-space:normal;">{{ $item->p_description }}</td>
                                <td class="text-center">{{ $item->buying_qty }}</td>
                                <td class="text-center">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-center">{{ number_format($item->buying_price, 2) }}</td>
                                <td class="text-center">
                                     @if ($item->status == "0")
                                        <span class="badge rounded-pill bg-light-warning text-warning w-100">Pending</span>
                                     @endif
                                </td>
                                <td>

                                    @if($item->status == "0")
                                        <a href="{{ route('purchase.approve', $item->id) }}" class="btn btn-sm btn-success">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th width="8%">Purchase No</th>
                            <th width="8%">Purchase Date</th>
                            <th>Product Name</th>
                            <th width="10%">Supplier Name</th>
                            <th>Purchase Details</th>
                            {{-- <th width="12%">Category</th> --}}
                            <th width="5%">Qty</th>
                            <th width="8%">Purchase Price</th>
                            <th width="8%">Total Price</th>
                            <th width="5%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


