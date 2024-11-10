@extends('backend.master')

@section('main-content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Invoice Print</div>
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
                <div id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <a href="javascript:window.print()" class="btn btn-dark"><i class="lni lni-printer"></i> PRINT </a>
                            <button type="button" class="btn btn-danger"><i class="lni lni-cloud-download"></i>DOWNLOAD</button>
                        </div>
                        <hr />
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                            <img src="{{ asset('logo/logo.png') }}" width="150" alt="logo" />
                                        </a>
                                    </div>
                                    <div class="col company-details">

                                        <h2 class="name">
                                            <a target="_blank" href="https://hypershop.com.bd/">
                                                Hypershop.com.bd
                                            </a>
                                        </h2>
                                        <div>914, Floor 9(Lift-8), Shah Ali Plaza, Mirpur-10,Dha ka, Bangladesh</div>
                                        <div>+8801822-666664</div>
                                        <div>support@hypershop.com.bd</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">{{ $payment['customer']['customer_name'] }}</h2>
                                        <div class="address">{{ $invoice->description }}</div>
                                        <div class="email">{{ $payment['customer']['c_phone']  }}</div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE #{{ $invoice->invoice_no }}</h1>
                                        <div class="date">Date of Invoice: {{ date('d-m-Y', strtotime($invoice->date)) }}</div>
                                        {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr class="text-center bg-dark">
                                            <th width="5%">#</th>
                                            <th class="text-center">CATEGORY</th>
                                            <th class="text-center">PRODUCT NAME</th>
                                            <th>QTY</th>
                                            <th>UNITE PRICE</th>
                                            <th class="text-right">TOTAL PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $total_sum = '0';
                                        @endphp

                                        @foreach ( $invoice['invoice_details'] as $key => $item )
                                            <tr class="text-center">
                                                <td class="no">{{ $key+1 }}</td>
                                                <td class="text-left"><h3>{{ $item['category']['category_name'] }}</h3></td>
                                                <td class="text-start">{{ $item['product']['product_name'] }}</td>
                                                <td>{{ $item->selling_qty }}</td>
                                                <td class="qty">{{ number_format($item->unit_price, 2) }}</td>
                                                <td class="unit">{{ number_format($item->selling_price, 2) }}</td>
                                            </tr>
                                            @php
                                            $total_sum += $item->selling_price
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            {{-- <td colspan="3"></td> --}}
                                            <td colspan="5"><strong>SUBTOTAL</strong></td>
                                            <td class="unit"><strong>{{ number_format($total_sum, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">DISCOUNT AMOUNT</td>
                                            <td class="unit">{{ number_format($payment->discount_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">PAID AMOUNT</td>
                                            <td class="unit">{{ number_format($payment->paid_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">DUE AMOUNT</td>
                                            <td class="unit">{{ number_format($payment->due_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><strong>GRAND TOTAL</strong></td>
                                            <td class="total text-white"><strong>{{ number_format($payment->total_amount, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">The item shall be in the original packaging and returned with any accessories or free gifts within 7 days from the day it was delivered.</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
