@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Purchase</div>
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="p-4 border rounded">

                        <form class="row g-3 pb-2">
                            {{-- purchase date --}}
                            <div class="form-group col-md-4">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input class="result form-control" type="text" id="date" name="purchase_date" value="{{ date('Y-m-d') }}">
                            </div>
                            {{-- purchase no --}}
                            <div class="form-group col-md-4">
                                <label for="purchase_no" class="form-label">Purchase No</label>
                                <input class="form-control" type="text" id="purchase_no" name="purchase_no" placeholder="Enter Purchase No">
                            </div>

                            {{-- Supplier ID --}}
                            <div class="form-group col-md-4">
                                <label for="supplier_id" class="form-label">Supplier Name</label>
                                <select class="single-select form-control" name="supplier_id" id="supplier_id">
                                    <option value=""></option>
                                    @foreach ($supplier as $item )
                                        <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Category ID --}}
                            <div class="form-group col-md-4">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select class="single-select form-control" name="category_id" id="category_id">

                                    {{-- SHOW ALL THE CATEGORY NAME --}}

                                </select>
                            </div>

                            {{-- Product ID --}}
                            <div class="form-group col-md-4">
                                <label for="product_id" class="form-label">Product Name</label>
                                <select class="single-select form-control" name="product_id" id="product_id">

                                 {{-- SHOW ALL THE PRODUCTS NAME --}}

                                </select>
                            </div>

                            <div class="col-md-4">
                                <button class="purchase btn btn-sm btn-dark addEventMore" type="button"><i class="fadeIn animated bx bx-plus-circle"></i> Add More</button>
                            </div>
                        </form> {{-- End Row --}}

                        <hr>

                        <form action="{{ route('purchase.store') }}" method="POST" class="pt-2">
                            @csrf

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="word-wrap: break-word; min-width:80px; max-width:150px; white-space:normal;">Category</th>
                                        <th style="word-wrap: break-word; min-width:220px; max-width:300px; white-space:normal;">Product Name</th>
                                        <th>Unit (Qty)</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">




                                    {{-- PRODUCT INSERT --}}




                                </tbody>

                                <tfoot class="table table-sm table-bordered" id="tfoot">
                                    <tr class="fw-bold">
                                        <td colspan="5" class="text-end">Grand Total</td>
                                        <td>
                                            <input type="text" name="estimated_amount" id="estimated_amount" class="form-control estimated_amount text-end" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>


                            <div class="form-group">
                                <button type="submit" class="btn btn-success" id="storePurchase">Save Purchase</button>
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

        $("#tfoot").hide();

        // ADD PURCHASE
        $(document).on("click", ".addEventMore", function(){
            var purchase_date = $("#date").val();
            var purchase_no = $("#purchase_no").val();
            var supplier_id = $("#supplier_id").val();
            var category_id = $("#category_id").val();
            var category_name = $("#category_id").find('option:selected').text();
            var product_id = $("#product_id").val();
            var product_name = $("#product_id").find('option:selected').text();

            // Validation Message
            if(purchase_no == ""){
                $("#purchase_no").notify("Purchase no is required");
            }else if(supplier_id == ""){
                $("#supplier_id").notify("Select Supplier Name");
            }else if(category_id == ""){
                $("#category_id").notify("Select Category Name");
            }else if(product_id == ""){
                $("#product_id").notify("Select Product Name");
            }else{

                // Then Insert Item Rows
                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);

                var data = {
                    purchase_date: purchase_date,
                    purchase_no: purchase_no,
                    supplier_id: supplier_id,
                    category_id: category_id,
                    category_name: category_name,
                    product_id: product_id,
                    product_name: product_name
                }

                var html = tamplate(data);
                $("#addRow").append(html);
                $("#tfoot").show();
            }
            
        });

        // DELETE PURCHASE
        $(document).on("click", ".removeEventMore", function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice(); // Calling for remove from Total Invoice Price
        });

        // CHANGE QTY WISE PRICE
        $(document).on("keyup click", ".buying_qty, .unit_price", function(){
            var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var total_buying_price =  (buying_qty*unit_price).toFixed(2);
            $(this).closest("tr").find("input.buying_price").val(total_buying_price);

            totalAmountPrice(); // Calling for Total Invoice Price
        });

        // CALCULATE SUM OF AMOUNT IN INVOICE
        function totalAmountPrice(){
            var sum = 0;
            $(".buying_price").each(function(){
                var value = $(this).val();

                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });

            $("#estimated_amount").val(sum.toLocaleString('en-US', { style: 'currency', currency: 'BDT' }));
        }
   });
</script>


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="purchase_date[]" value="@{{ purchase_date }}">
        <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
        <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">

        <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
            @{{ category_name }}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
            @{{ product_name }}
        </td>
        <td>
            <input type="number" min="1" class="form-control buying_qty text-end" name="buying_qty[]" value="">
        </td>
        <td>
            <input type="number" class="form-control unit_price text-end" name="unit_price[]" value="">
        </td>
        <td>
            <input type="text" class="form-control p_description text-end" name="p_description[]">
        </td>
        <td>
            <input type="text" class="form-control buying_price text-end" name="buying_price[]" value="0" readonly>
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

        // GET CATEGORY NAME WITH THE HELP OF SUPPLIER ID
        $(document).on("change", "#supplier_id", function(){
            var supplier_id = $(this).val();
           $.ajax({
                url: "{{ route('get-category') }}",
                type: "GET",
                data:{
                    supplier_id: supplier_id
                },
                dataType: "JSON",
                success: function(data){
                    var html =`<option value="">Select Category</option>`;

                    $.each(data, function(key, value){
                        html += `<option value="${value.category_id}">${ value.category.category_name }</option>`;
                    });

                    $("#category_id").html(html);
                }
           });
        });

    });
</script>

@endsection
