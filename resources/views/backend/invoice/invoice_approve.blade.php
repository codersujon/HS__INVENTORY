@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Invoice Approve</div>
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
            <div class="p-4 border rounded">
                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-md-6">
                        <h4>Invoice No: #{{ $invoice->invoice_no }} - {{ date('d-m-Y', strtotime($invoice->date)) }}
                        </h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('invoice.pending') }}" class="btn btn-primary radius-30">
                            <i class="fadeIn animated bx bx-list-ul"></i> Processing Invoice List
                        </a>
                    </div>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-light mb-0">
                        <thead>
                            <tr>
                                <td scope="col"><strong>Customer Info:</strong> </td>
                                <td scope="col"><strong>Customer Name:</strong>
                                    {{ $payment['customer']['customer_name'] }}
                                </td>
                                <td scope="col"><strong>Mobile No:</strong> {{ $payment['customer']['c_phone'] }}</td>
                                <td scope="col"><strong>Gender:</strong> {{ $payment['customer']['c_gender'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td colspan="3">{{ $invoice->description }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <form action="{{ route('invoice.approval.store', $invoice->id) }}" method="POST">
                    @csrf

                    <table class="table mb-0 table-bordered">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th>#SL</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th class="bg-dark">Current Stock</th>
                                <th>Quantity</th>
                                <th>Unite Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total_sum = '0';
                            @endphp

                            @foreach ($invoice['invoice_details'] as $key => $item )
                            <tr>

                                <input type="hidden" name="category_id[]" value="{{ $item->category_id }}">
                                <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                <input type="hidden" name="selling_qty[{{ $item->id }}]" value="{{ $item->selling_qty }}">


                                <td>{{ $key+1 }}</td>
                                <td>{{ $item['category']['category_name'] }}</td>
                                <td
                                    style="word-wrap: break-word; min-width:200px; max-width:200px; white-space:normal;">
                                    {{ $item['product']['product_name'] }}</td>
                                <td class="text-end bg-dark text-white">{{ $item['product']['quantity'] }}</td>
                                <td class="text-end">{{ $item->selling_qty }}</td>
                                <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-end">{{ number_format($item->selling_price, 2) }}</td>
                            </tr>

                            @php
                            $total_sum += $item->selling_price
                            @endphp
                            @endforeach

                            <tr>
                                <td colspan="6" class="text-end"><strong>Sub Total</strong></td>
                                <td class="text-end"><strong>{{ number_format($total_sum, 2) }}</strong></td>
                            </tr> 
                            <tr>
                                <td colspan="6" class="text-end">Shipping Charge</td>
                                <td class="text-end">{{ number_format($payment->shipping_charge, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end">Discount Amount</td>
                                <td class="text-end">{{ number_format($payment->discount_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end">Paid Amount</td>
                                <td class="text-end">{{ number_format($payment->paid_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end">Due Amount</td>
                                <td class="text-end">{{ number_format($payment->due_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-end"><strong>Grand Total</strong></td>
                                <td class="text-end"><strong>{{ number_format($payment->total_amount + $payment->shipping_charge, 2) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success mt-3" type="submit">Save As On Deliver</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
