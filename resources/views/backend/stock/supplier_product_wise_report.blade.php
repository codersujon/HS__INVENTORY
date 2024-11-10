@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Supplier and Product Wise Report</div>
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
            <div class="p-4 border rounded">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <h5>
                            <strong>Supplier Wise Report</strong>
                            <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value">

                            &nbsp;&nbsp;

                            <strong>Product Wise Report</strong>
                            <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                        </h5>

                    </div>
                </div>  {{-- End Row --}}

                {{-- SUPPLIER WISE SHOW SUPPLIER --}}
                <div class="show_supplier" style="display: none;">
                    <form action="{{ route('supplier.wise.pdf') }}" method="POST" id="SearchSupplier" target="_blank">
                        @csrf
                        <div class="row">

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="supplier_id" class="mb-2">Supplier Name</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control single-select">
                                        <option value="">--Select Supplier Name--</option>
                                        @foreach ($suppliers as $item )
                                            <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" style="margin-top: 28px">
                                <button type="submit" class="btn btn-primary px-4">Search</button>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- PRODUCT WISE START --}}
                <div class="show_product" style="display: none;">
                    <form action="{{ route('product.wise.pdf') }}" method="POST" id="SearchProduct" target="_blank">
                        @csrf
                        <div class="row">

                            {{-- Category ID --}}
                            <div class="form-group col-md-4">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select class="single-select form-control" name="category_id" id="category_id">

                                    <option value="">--Select Category Name--</option>
                                    @foreach ($category as $item )
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Product ID --}}
                            <div class="form-group col-md-4">
                                <label for="product_id" class="form-label">Product Name</label>
                                <select class="single-select form-control" name="product_id" id="product_id">
                                 {{-- SHOW ALL THE PRODUCTS NAME --}}

                                </select>
                            </div>
                            <div class="col-sm-4" style="margin-top: 28px">
                                <button type="submit" class="btn btn-primary px-4">Search</button>
                            </div>

                        </div>
                    </form>
                </div>{{-- PRODUCT WISE END --}}

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
     // GET PRODUCT
     $(document).on("change", ".search_value", function(){
        var ProductWiseReport = $(this).val();
        if(ProductWiseReport == 'product_wise'){
                $(".show_product").show();
        }else{
            $(".show_product").hide();
        }
    });

     // GET SUPPLIER
     $(document).on("change", ".search_value", function(){
        var search_value = $(this).val();
        if(search_value == 'supplier_wise'){
                $(".show_supplier").show();
        }else{
            $(".show_supplier").hide();
        }
    });


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
                        var html =`<option value="">--Select Product Name--</option>`;

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
   });
</script>

@endsection
