@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Stock Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Stock</li>
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
                    <a href="{{ route('stock.report.print') }}" target="_blank" class="btn btn-primary radius-30"><i class="bx bx-printer"></i>Stock Report Print</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#SN</th>
                            <th width="10%" class="text-center">Supplier Name</th>
                            <th width="10%" class="text-center">Category</th>
                            <th width="10%" class="text-center">Product SKU</th>
                            <th width="32%" class="text-center">Product Name</th>
                            <th width="5%" class="text-center">Unit</th>
                            <th width="5%" class="text-center">Qty</th>
                            <th width="8%" class="text-center">Unit Price</th>
                            <th width="15%" class="text-center">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                        <tr>
                            <td>{{ $key+1; }}</td>
                            <td class="text-center">{{ $item['product']['supplier']['supplier_name'] }}</td>
                            <td class="text-center">{{ $item['product']['category']['category_name'] }}</td>
                            <td class="text-center">{{ $item['product']['product_sku'] }}</td>
                            <td style="word-wrap: break-word; min-width:200px; max-width:200px; white-space:normal;">
                                {{ $item['product']['product_name'] }}</td>
                            <td class="text-center">{{ strtoupper($item['product']['unit']['name']) }}</td>
                            <td class="text-center">{{ $item['product']['quantity'] }}</td>
                            <td class="text-center">{{ $item['unit_price'] }}</td>
                            <td class="text-end">{{ number_format($item['product']['quantity'] * $item['unit_price'], 2)  }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%" class="text-center">#SN</th>
                            <th width="10%" class="text-center">Supplier Name</th>
                            <th width="10%" class="text-center">Category</th>
                            <th width="10%" class="text-center">Product SKU</th>
                            <th width="32%" class="text-center">Product Name</th>
                            <th width="5%" class="text-center">Unit</th>
                            <th width="5%" class="text-center">Qty</th>
                            <th width="8%" class="text-center">Unit Price</th>
                            <th width="15%" class="text-center">Total Price</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
