@extends('backend.master')

@section('main-content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Stock Report</div>
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
                <div id="invoice">
                    <div class="toolbar hidden-print d-flex justify-content-between">
                        <div>
                            <h4 class="text-primary">SUPPLIER WISE STOCK REPORT</h4>
                        </div>
                        <div class="text-end">
                            <a href="javascript:window.print()" class="btn btn-dark"><i class="lni lni-printer"></i> PRINT </a>
                            <button type="button" class="btn btn-danger"><i class="lni lni-cloud-download"></i>DOWNLOAD</button>
                        </div>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">

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
                                <h3 class="text-center text-primary">Supplier Name: {{ $allData['0']['supplier']['supplier_name'] }}</h3>
                                <table>
                                    <thead>
                                        <tr class="text-center bg-dark">
                                            <th width="5%">#SN</th>
                                            <th width="15%">Supplier Name</th>
                                            <th width="15%">Category</th>
                                            <th width="50%">Product Name</th>
                                            <th width="6%">Stock</th>
                                            <th width="6%">Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ( $allData as $key => $item )
                                            <tr class="text-center">
                                                <td class="no">{{ $key+1 }}</td>
                                                <td>{{ $item['supplier']['supplier_name'] }}</td>
                                                <td class="text-center">{{ $item['category']['category_name'] }}</td>
                                                <td class="text-start"><h3>{{ ucwords($item->product_name) }}</h3></td>
                                                <td class="unit text-center" class="text-center">{{ $item->quantity }}</td>
                                                <td>{{ strtoupper($item['unit']['name']) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
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
