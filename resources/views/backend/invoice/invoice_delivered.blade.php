@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Delivered Invoice</div>
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
                            <th width="5%" class="text-center">#SN</th>
                            <th width="8%" class="text-center">Date</th>
                            <th width="10%" class="text-center">Invoice No</th>
                            <th width="20%" class="text-center">Customer Name</th>
                            <th width="10%" class="text-center">Contact Number</th>
                            <th width="8%" class="text-center">Amount</th>
                            <th class="text-center">Address</th>
                            <th width="5%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td class="text-center">#{{ $item->invoice_no }}</td>
                                <td>{{ $item['payment']['customer']['customer_name'] }}</td>
                                <td class="text-center">{{ $item['payment']['customer']['c_phone'] }}</td>
                                <td class="text-end">{{  number_format($item['payment']['total_amount'], 2) }}</td>
                                <td style="word-wrap: break-word; min-width:200px; max-width:200px; white-space:normal;">{{ $item['payment']['customer']['address'] }}</td>
                                <td>

                                    @if($item->status == "2")
                                        {{-- <div class="d-flex align-items-center bg-light-success text-success rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Delivered</span>
                                        </div> --}}
                                        <div class="badge rounded-pill bg-success w-100">Delivered</div>
                                    @endif

                                </td>
                                <td>
                                    @if($item->status == "2")
                                        <a href="{{ route('invoice.details', $item->id) }}" class="btn btn-sm bg-primary text-white">
                                            <i class="lni lni-eye"></i>Details
                                        </a>
                                    @endif

                                    {{-- <a href="{{ route('invoice.details', $item->id) }}" class="btn btn-sm bg-danger text-white">PDF</a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%" class="text-center">#SN</th>
                            <th width="8%" class="text-center">Date</th>
                            <th width="10%" class="text-center">Invoice No</th>
                            <th width="20%" class="text-center">Customer Name</th>
                            <th width="10%" class="text-center">Contact Number</th>
                            <th width="8%" class="text-center">Amount</th>
                            <th class="text-center">Address</th>
                            <th width="5%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


