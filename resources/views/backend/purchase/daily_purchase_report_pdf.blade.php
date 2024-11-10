@extends('backend.master')

@section('main-content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Daily Purchase Report</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Reports</li>
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
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <h4>DAILY PURCHASE REPORT</h4>
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
                                            <th width="7%">PURCHASE NO</th>
                                            <th width="6%">DATE</th>
                                            <th class="text-left">PRODUCT NAME</th>
                                            <th class="text-left">SUPPLIER NAME</th>
                                            <th width="5%">QTY</th>
                                            <th class="text-center">PURCHASE PRICE</th>
                                            <th class="text-center">TOTAL PRICE</th>
                                            <th class="text-center" width="10%">CREATED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $total_sum = '0';
                                        @endphp

                                        @foreach ( $allData as $key => $item )
                                            <tr class="text-center">
                                                <td class="no">{{ $key+1 }}</td>
                                                <td class="text-center" style="word-wrap: break-word; min-width:120px; max-width:200px; white-space:normal;"><h3>#{{ $item->purchase_no }}</h3></td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($item->purchase_date)) }}</td>
                                                <td style="word-wrap: break-word; min-width:150px; max-width:200px; white-space:normal;">{{ $item['product']['product_name'] }}</td>
                                                <td class="text-center"><h3>{{ ucwords($item['supplier']['supplier_name']) }}</h3></td>
                                                <td class="text-center">{{ $item->buying_qty }}</td>
                                                <td class="text-center">{{ number_format($item->unit_price, 2) }}</td>
                                                <td class="text-center">{{ number_format($item->buying_price, 2) }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                            </tr>
                                            @php
                                                $total_sum += $item->buying_price;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7"><strong>GRAND TOTAL</strong></td>
                                            <td><strong>{{ number_format($total_sum, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </main>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <a href="{{ route('generate-pdf') }}" class="btn btn-dark"><i class="lni lni-printer"></i> PRINT </a>
                            <button type="button" class="btn btn-danger"><i class="lni lni-cloud-download"></i>DOWNLOAD</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
