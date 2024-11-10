@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
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
            <div class="card border-top border-0 border-4 border-dark">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-dark"></i>
                        </div>
                        <h5 class="mb-0 text-dark">Edit Product</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="productForm" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Product Name --}}
                        <div class="form-group col-md-12">
                            <label for="productN" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="productN" id="productN"
                                placeholder="Product Name" value="{{ $product->product_name }}">
                        </div>

                        {{-- Supplier Name --}}
                        <div class="form-group col-md-6">
                            <label for="supplier_id" class="form-label">Supplier Name</label>
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option selected>Supplier Name</option>
                                @foreach ($supplier as $item )
                                    <option value="{{ $item->id }}" {{ $item->id == $product->supplier_id? 'selected':'' }}>{{ $item->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Unit Name --}}
                        <div class="form-group col-md-6">
                            <label for="unit_id" class="form-label">Unit Name</label>
                            <select name="unit_id" id="unit_id" class="form-control">
                                <option value="">Product Unit</option>
                                @foreach ($unit as $item )
                                    <option value="{{ $item->id }}" {{ $item->id == $product->unit_id ? 'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Category Name --}}
                        <div class="form-group col-md-6">
                            <label for="category_id" class="form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Product Category</option>
                                @foreach ($category as $item )
                                    <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected':'' }}>{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                         {{-- Shelf Name --}}
                         <div class="form-group col-md-6">
                            <label for="shelf_id" class="form-label">Shelf Name</label>
                            <select name="shelf_id" id="shelf_id" class="form-control single-select">
                                <option value="">Shelf Name</option>
                                @foreach ($shelf as $item )
                                    <option value="{{ $item->id }}" {{ $item->id == $product->shelf_id ? 'selected':'' }}>{{ $item->shelves_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Product Quantity --}}
                        {{-- <div class="form-group col-md-6">
                            <label for="p_qty" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="p_qty" id="p_qty"
                                value="{{ $product->quantity }}">
                        </div> --}}

                        {{-- Product Image --}}
                        <div class="form-group col-12">
                            <label for="p_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="p_image" id="p_image">
                        </div>

                        {{-- Show Product Image --}}
                        <div class="form-group col-12 ">
                            <img src="{{ (!empty($product->product_image))? url('upload/product/'.$product->product_image): url('upload/No_Image.jpg') }}" class="p-1 rounded-circle" al t="user avatar" width="110" id="showImage">
                        </div>

                        {{-- Product Description --}}
                        <div class="form-group col-md-12">
                            <label for="product_desc" class="form-label">Product Description</label>
                            <textarea name="product_desc" id="product_desc" class="form-control" rows="2">{{ $product->product_desc }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-dark px-5" id="save_product">Update Product</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // IMAGE UPLOAD AND SHOW
    $(document).ready(function(){
        $("#p_image").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showImage").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
