@extends('backend.master')

@section('main-content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Daily Invoice Report</div>
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
                                        <h4>DAILY INVOICE REPORT</h4>
                                        <div class="date">
                                            <span class="btn btn-dark">{{ date('d-m-Y', strtotime($start_date)) }}</span>
                                            <span> - </span>
                                            <span class="btn btn-danger">{{ date('d-m-Y', strtotime($end_date)) }}</span>
                                        </div>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="https://hypershop.com.bd/">
                                                Hypershop.com.bd
                                            </a>
                                        </h2>
                                        <div>914, Floor 9(Lift-8), Shah Ali Plaza, Mirpur-10,Dha ka, Bangladesh</div>
                                        <div>+8801822-666664</div>
                                        <div>admin@hypershop.com.bd</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <table>
                                    <thead>
                                        <tr class="text-center bg-dark">
                                            <th width="5%">#</th>
                                            <th width="10%">INVOICE NO</th>
                                            <th width="10%">DATE</th>
                                            <th class="text-left">CUSTOMER NAME</th>
                                            <th class="text-left">GENDER</th>
                                            <th width="20%">PHONE NO</th>
                                            <th class="text-right">AMMOUNT</th>
                                            <th class="text-right" width="14%">CREATED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $total_sum = '0';
                                        @endphp

                                        @foreach ( $allData as $key => $item )
                                            <tr class="text-center">
                                                <td class="no">{{ $key+1 }}</td>
                                                <td><h3>#{{ $item->invoice_no }}</h3></td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                <td class="text-start"><h3>{{ ucwords($item['payment']['customer']['customer_name']) }}</h3></td>
                                                <td class="text-left">{{ ucwords($item['payment']['customer']['c_gender']) }}</td>
                                                <td>{{ $item['payment']['customer']['c_phone'] }}</td>
                                                <td class="unit">{{  number_format($item['payment']['total_amount'], 2) }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                            </tr>
                                            @php
                                            $total_sum += $item['payment']['total_amount']
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        {{-- <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><strong>SUBTOTAL</strong></td>
                                            <td><strong>{{ number_format($total_sum, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">DISCOUNT AMOUNT</td>
                                            <td>{{ number_format($payment->discount_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">PAID AMOUNT</td>
                                            <td>{{ number_format($payment->paid_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">DUE AMOUNT</td>
                                            <td>{{ number_format($payment->due_amount, 2) }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td colspan="6"><strong>TOTAL SALES</strong></td>
                                            <td><strong>{{ number_format($total_sum, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </main>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
