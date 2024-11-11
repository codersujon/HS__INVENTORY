@extends('backend.master')

@section('main-content')

<div class="page-content">

    <div class="row row-cols-1 row-cols-sm-3">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Today's Orders</p>
                            <h4 class="my-1 text-white">{{ $invoices->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35"><i class="bx bx-cart-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
                $onPacking = App\Models\Invoice::where('status','0')->get();
                $onDelivery = App\Models\Invoice::where('status','1')->get();
                $delivered = App\Models\Invoice::where('status','2')->get();
                $returned = App\Models\Invoice::where('status','3')->get();
                $totalOrder = App\Models\Invoice::all();
        @endphp

        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Orders On Packing</p>
                            <h4 class="my-1 text-white">{{ $onPacking->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="fadeIn animated bx bx-package"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Orders On Delivery</p>
                            <h4 class="text-white my-1">{{ $onDelivery->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="lni lni-delivery"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-3">
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders Received</p>
                            <h4 class="my-1 text-white">{{ $totalOrder->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="lni lni-cart-full"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-lush">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders Delivered</p>
                            <h4 class="my-1 text-white">{{ $delivered->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="fadeIn animated bx bx-check-shield"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-burning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders Returned</p>
                            <h4 class="my-1 text-white">{{ $returned->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="lni lni-spinner-arrow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2">
        <div class="col">
            <div class="card radius-10 bg-gradient-cosmic">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Users</p>
                            <h4 class="text-white my-1">{{ Auth::user()->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="bx bxs-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-blues">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Customer</p>
                            <h4 class="text-white my-1">{{ $customers->count() }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35">
                            <i class="bx bx-user-plus fs-3 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-3 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $suppliers->count() }}</h5>
                        <div class="ms-auto">
                            {{-- <i class="lni lni-delivery fs-3 text-white"></i> --}}
                            <i class="bx bx-duplicate fs-3 text-white"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Supplier</p>
                        {{-- <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $category->count() }}</h5>
                        <div class="ms-auto">
                            <i class="bx bx-store-alt fs-3 text-white"></i>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Category</p>
                        {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $products->count(); }}</h5>
                        <div class="ms-auto">
                            <i class="bx bx-cart fs-3 text-white"></i>
                        </div>
                    </div>
                   
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Product</p>
                        {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    @php
        $today = now()->format('Y-m-d');
        $total_purchase = App\Models\Purchase::where('purchase_date', $today)->where('status', '1')->sum('buying_price');
        $total_sales =  App\Models\Payment::whereDate('created_at', $today)->sum('total_amount');
    @endphp

<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-2">
    <div class="col">
        <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">&#2547; {{ number_format($total_purchase, 2) }}</h5>
                    <div class="ms-auto">
                        <i class="lni lni-cart-full fs-3 text-white"></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Today's Total Purchase</p>
                    {{-- <small class="text-end">1.4% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-lush">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">&#2547; {{ number_format($total_sales, 2) }}</h5>
                    <div class="ms-auto">
                        <i class="lni lni-shopping-basket fs-3 text-white"></i>
                    </div>
                </div>
                <div class="progress my-3 bg-light-transparent" style="height:3px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Today's Total Sales</p>
                    {{-- <small class="text-end">5.43% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5>Today's Orders Summary</h5>
                    </div>
                </div>
                <div class="table-responsive mt-1">
                    <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                        <thead class="table-light">
                            <tr>
                                <th width="12%">Order id</th>
                                <th width="13%">Order Date</th>
                                <th class="text-center">Customer Name</th>
                                <th width="15%">Mobile No</th>
                                <th width="10%">Total Price</th>
                                <th width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($allData as $key => $item)
                                <tr>
                                    <td>#{{ $item->invoice_no }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                    <td class="text-center">{{ ucwords($item['payment']['customer']['customer_name']) }}</td>
                                    <td>{{ ucwords($item['payment']['customer']['c_phone']) }}</td>
                                    <td class="text-end">{{  number_format($item['payment']['total_amount'], 2) }}</td>
                                    <td>
                                    @if($item->status == "0")
                                    <div class="d-flex align-items-center text-primary rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                        <span>Processing</span>
                                    </div>
                                    @elseif($item->status == "1")
                                        <div class="d-flex align-items-center text-info rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>On Delivery</span>
                                        </div>
                                    @elseif($item->status == "2")
                                        <div class="d-flex align-items-center text-success rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Delivered</span>
                                        </div>
                                    @elseif($item->status == "3")
                                        <div class="d-flex align-items-center text-danger rounded-pill px-3">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>Returned</span>
                                        </div>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Row-->

</div>

@endsection
