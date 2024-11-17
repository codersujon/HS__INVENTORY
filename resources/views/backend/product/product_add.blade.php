@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-7">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Add Product</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="productForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Product Name --}}
                        <div class="form-group col-md-8">
                            <label for="productN" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="productN" id="productN"
                                placeholder="Product Name">
                        </div>

                        {{-- Product SKU --}}
                        <div class="form-group col-md-4">
                            <label for="p_sku" class="form-label">Product SKU</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="p_sku" 
                                id="p_sku" disabled
                            >
                        </div>

                        {{-- Supplier Name --}}
                        <div class="form-group col-md-6">
                            <label for="supplier_id" class="form-label">Supplier Name</label>
                            <select name="supplier_id" id="supplier_id" class="form-control single-select">
                                <option value="">Supplier Name</option>
                                @foreach ($supplier as $item )
                                    <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Unit Name --}}
                        <div class="form-group col-md-6">
                            <label for="unit_id" class="form-label">Unit Name</label>
                            <select name="unit_id" id="unit_id" class="form-control single-select">
                                <option value="">Product Unit</option>
                                @foreach ($unit as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Category Name --}}
                        <div class="form-group col-md-6">
                            <label for="category_id" class="form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control single-select">
                                <option value="">Product Category</option>
                                @foreach ($category as $item )
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Shelf Name --}}
                        <div class="form-group col-md-6">
                            <label for="shelf_id" class="form-label">Shelf Name</label>
                            <select name="shelf_id" id="shelf_id" class="form-control single-select">
                                <option value="">Shelf Name</option>
                                @foreach ($shelf as $item )
                                    <option value="{{ $item->id }}">{{ $item->shelves_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Product Quantity --}}
                        {{-- <div class="form-group col-md-6">
                            <label for="p_qty" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="p_qty" id="p_qty"
                                placeholder="Product Quantity">
                        </div> --}}

                        {{-- Product Image --}}
                        <div class="form-group col-12">
                            <label for="p_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="p_image" id="p_image">
                        </div>

                        {{-- Show Product Image --}}
                        <div class="form-group col-12 ">
                            <img src="{{ (!empty($adminData->profile_image))? url('upload/product/'.$adminData->profile_image): url('upload/No_Image.jpg') }}" class="p-1 rounded-circle" al t="user avatar" width="110" id="showImage">
                        </div>

                        {{-- Product Description --}}
                        <div class="form-group col-md-12">
                            <label for="product_desc" class="form-label">Product Description</label>
                            <textarea name="product_desc" id="product_desc" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary px-5" id="save_product">Save Product</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        // IMAGE UPLOAD AND SHOW
        $("#p_image").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showImage").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        // PRODUCT SKU GENERATE
        function generateSku(){
            let prefix = "HS";
            var randomSuffix = Math.floor(Math.random() * 900000) + 100000;
            var productSKU = prefix + '-' + randomSuffix;
            $("#p_sku").val(productSKU);
        }
        generateSku();
    });
</script>
@endsection
