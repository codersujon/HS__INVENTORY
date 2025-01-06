@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Invoice</div>
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <div class="p-4 border rounded">

                        <form class="row g-3 pb-2">

                            <div class="row">
                                {{-- invoice no --}}
                                <div class="form-group col-md-2">
                                   <label for="invoice_no" class="form-label">Invoice No</label>
                                   <input class="form-control" type="text" id="invoice_no" name="invoice_no" value="{{ mt_rand(100000,999999) }}">
                               </div>
                            </div>

                            {{-- invoice date --}}
                            <div class="form-group col-md-2">
                                <label for="invoice_date" class="form-label">Invoice Date</label>
                                <input class="result form-control" type="text" id="date" name="invoice_date" value="{{ date('d-m-Y') }}">
                            </div>

                            {{-- Category ID --}}
                            <div class="form-group col-md-3">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select class="single-select form-control" name="category_id" id="category_id">

                                    <option value=""></option>
                                    @foreach ($category as $item )
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Product ID --}}
                            <div class="form-group col-md-3">
                                <label for="product_id" class="form-label">Product Name</label>
                                <select class="single-select form-control" name="product_id" id="product_id">

                                 {{-- SHOW ALL THE PRODUCTS NAME --}}

                                </select>
                            </div>

                             {{-- current stock qty --}}
                             <div class="form-group col-md-2">
                                <label for="current_stock_qty" class="form-label">Stock(PCS/KG)</label>
                                <input class="form-control" type="text" id="current_stock_qty" name="current_stock_qty" readonly>
                            </div>

                            <div class="col-md-2">
                                <button class="purchase btn btn-sm btn-dark addEventMore" type="button"><i class="fadeIn animated bx bx-plus-circle"></i> Add More</button>
                            </div>
                        </form> {{-- End Row --}}

                        <hr>

                        <form action="{{ route('invoice.store') }}" method="POST" class="pt-2">
                            @csrf

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="word-wrap: break-word; min-width:80px; max-width:150px; white-space:normal;">Category</th>
                                        <th style="word-wrap: break-word; min-width:220px; max-width:300px; white-space:normal;">Product Name</th>
                                        <th width="10%">Unit (Qty)</th>
                                        <th width="10%">Unit Price</th>
                                        <th width="15%">Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">


                                    {{-- PRODUCT INSERT --}}


                                </tbody>

                                <tfoot class="table table-sm table-bordered" id="tfoot">
                                    <tr class="fw-bold">
                                        <td colspan="4" class="text-end">Discount Amount</td>
                                        <td>
                                            <input type="text" name="discount_amount" id="discount_amount" class="form-control text-end" placeholder="Discount Amount">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="4" class="text-end">Grand Total</td>
                                        <td>
                                            <input type="text" name="estimated_amount" id="estimated_amount" class="form-control estimated_amount text-end" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>


                            {{-- paid status --}}
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    {{-- customer name --}}
                                    <div class="form-group">
                                        <label for="customer_id">Customer Name</label>
                                        <select name="customer_id" id="customer_id" class="form-select single-select">
                                            <option value="">Select Customer</option>
                                            <option value="0">New Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customer_name }} - {{ $customer->c_phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{-- shipping charge --}}
                                    <div class="form-group">
                                        <label for="shipping_charge">Shipping Charge</label>
                                        <select name="shipping_charge" id="shipping_charge" class="form-select single-select">
                                            <option value="">Select Delivery Charge</option>
                                            @foreach($shippingCharges as $shipping)
                                                <option value="{{ $shipping->shipping_charge }}">{{ $shipping->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {{-- paid status --}}
                                    <div class="form-group">
                                        <label for="paid_status">Paid Status</label>
                                        <select name="paid_status" id="paid_status" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                        <input type="text" name="paid_amount" id="paid_amount" class="form-control" placeholder="Enter Paid Amount" style="display: none;">
                                    </div>
                                </div>
                            </div> <!-- End Row -->

                            {{-- Start Customer Add Form --}}
                            <div class="row new_customer mb-3" style="display: none;">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="customerN" id="customerN"
                                        placeholder="Enter Customer Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="tel" class="form-control" name="c_phone" id="c_phone" minlength="11"
                                    maxlength="11" placeholder="Ex: 016********">
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="c_gender" id="c_gender" class="form-control">
                                        <option value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            {{-- End Customer Add Form --}}

                            {{-- Address --}}
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <textarea name="address" id="address" rows="1" placeholder="Write Address" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <textarea name="note" id="note" rows="1" class="form-control">প্রোডাক্ট না নিলে অবশ্যই ডেলিভারি চার্জ 120 টাকা নিতে হবে।</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info" id="storeInvoice">Save Invoice</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   $(document).ready(function(){

        // ADD PURCHASE
        $(document).on("click", ".addEventMore", function(){
            var invoice_no = $("#invoice_no").val();
            var invoice_date = $("#date").val();

            var category_id = $("#category_id").val();
            var category_name = $("#category_id").find('option:selected').text();

            var product_id = $("#product_id").val();
            var product_name = $("#product_id").find('option:selected').text();

            if(invoice_no == ""){
                $("#invoice_no").notify("Invoice no is required");
            }else if(invoice_date == ""){
                $("#date").notify("Invoice date is required");
            }else if(category_id == ""){
                $("#category_id").notify("Category name is required");
            }else if(product_id == ""){
                $("#product_id").notify("Product name is required");
            }else{
                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);

                var data = {
                    invoice_date: invoice_date,
                    invoice_no: invoice_no,
                    category_id: category_id,
                    category_name: category_name,
                    product_id: product_id,
                    product_name: product_name
                }
                var html = tamplate(data);
                $("#addRow").append(html);
            }
            
        });

        // DELETE PURCHASE
        $(document).on("click", ".removeEventMore", function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice(); // Calling for remove from Total Invoice Price
        });

        // CHANGE QTY WISE PRICE
        $(document).on("keyup click", ".selling_qty, .unit_price", function(){
            var selling_qty = $(this).closest("tr").find("input.selling_qty").val();
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var total_selling_price =  (selling_qty*unit_price).toFixed(2);
            $(this).closest("tr").find("input.selling_price").val(total_selling_price);

            $("#discount_amount").trigger('keyup');

        });

        // LOAD OUR TOTAL AMOUNT
        $(document).on("keyup", "#discount_amount", function(){
            totalAmountPrice();
        })

        // CALCULATE SUM OF AMOUNT IN INVOICE
        function totalAmountPrice(){
            var sum = 0;
            $(".selling_price").each(function(){
                var value = $(this).val();

                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });

            var discount_amount = parseFloat($("#discount_amount").val());
            if(!isNaN(discount_amount) && discount_amount.length != 0){
                    sum -= parseFloat(discount_amount);
            }

            $("#estimated_amount").val(sum.toFixed(2));
        }
   });
</script>


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="invoice_date" value="@{{ invoice_date }}">
        <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">

        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <input type="number" min="1" class="form-control selling_qty text-end" name="selling_qty[]" value="">
        </td>
        <td>
            <input type="number" class="form-control unit_price text-end" name="unit_price[]" value="">
        </td>
        <td>
            <input type="text" class="form-control selling_price text-end" name="selling_price[]" value="0" readonly>
        </td>
        <td>
            <i class="btn btn-danger btn-sm fadeIn animated bx bx-window-close removeEventMore"></i>
        </td>
    </tr>
</script>

<script type="text/javascript">
    $(function(){

         // GET PRODUCTS NAME WITH THE HELP OF CATEGORY ID
        $(document).on("change", "#category_id", function(){
            var category_id = $(this).val();
           $.ajax({
                url: "{{ route('get-product') }}",
                type: "GET",
                data:{
                    category_id: category_id
                },
                dataType: "JSON",
                success: function(data){
                    var html =`<option value="">Select Product</option>`;

                    $.each(data, function(key, value){
                        html += `<option value="${value.id}">${ value.product_name }</option>`;
                    });

                    $("#product_id").html(html);
                }
           });
        });

         // GET PRODUCTS STOCK WITH HELP OF PRODUCT ID
        $(document).on("change", "#product_id", function(){
            var product_id = $(this).val();
           $.ajax({
                url: "{{ route('get-product-stock') }}",
                type: "GET",
                data:{
                    product_id: product_id
                },
                dataType: "JSON",
                success: function(data){
                    $("#current_stock_qty").val(data);
                }
           });
        });

        // GET PARTIAL PAID INPUT
        $(document).on("change", "#paid_status", function(){
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid'){
                 $("#paid_amount").show();
            }else{
                $("#paid_amount").hide();
            }
        });

        // GET NEW CUSTOMER FROM
        $(document).on("change", "#customer_id", function(){
            var customer_id = $(this).val();
            if(customer_id == '0'){
                 $(".new_customer").show();
            }else{
                $(".new_customer").hide();
            }
        });

        // GET CUSTOMER ADDRESS
        $(document).on("change", "#customer_id", function(){
            var customer_id = $(this).val();
            $.ajax({
                url: "{{ route('get-customer-address') }}",
                type: "GET",
                data:{
                    customer_id: customer_id
                },
                dataType: "JSON",
                success: function(data){
                    $("#address").val(data.address);
                }
           });

        });

    });
</script>

@endsection
