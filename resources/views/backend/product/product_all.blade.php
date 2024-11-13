

@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Product</div>
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

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('product.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Product</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Product Name</th>
                            <th width="8%">Product Image</th>
                            <th width="6%">Shelf Name</th>
                            <th width="8%">Supplier Name</th>
                            <th width="6%">Category</th>
                            <th>Qty</th>
                            <th  width="5%">Unit</th>
                            <th width="4%">Status</th>
                            <th width="7%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td style="word-wrap: break-word; min-width:150px; max-width:200px; white-space:normal;">{{ $item->product_name }}</td>
                                <td class="text-center">
                                    <img src="{{ (!empty($item->product_image))? url('upload/product/'.$item->product_image): url('upload/No_Image.jpg') }}" alt="" width="100px" height="50px" class="rounded">
                                </td>
                                <td class="text-center">{{ isset($item['shelf']['shelves_name']) ? $item['shelf']['shelves_name'] : 'N/A' }}</td>
                                <td class="text-center">{{ isset($item['supplier']['supplier_name']) ? $item['supplier']['supplier_name'] : 'N/A' }}</td>
                                <td class="text-center">
                                    {{ isset($item['category']['category_name']) ? $item['category']['category_name'] : 'N/A' }}
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">
                                    {{ isset($item['unit']['name']) ? strtoupper($item['unit']['name']) : 'N/A' }}
                                </td>
                                <td class="text-center">
                                     @if ($item->status == "1")
                                     <span class="badge bg-success">Active</span>
                                     @else
                                        <span class="badge bg-danger">Inactive</span>
                                     @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Edit</a>
                                    <button class="btn btn-sm btn-danger deleteProduct" data-url="{{ route('product.delete', $item->id) }}">
                                        <i class="lni lni-trash"></i>Trash
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Product Name</th>
                            <th width="8%">Product Image</th>
                            <th width="6%">Shelf Name</th>
                            <th width="8%">Supplier Name</th>
                            <th width="6%">Category</th>
                            <th>Qty</th>
                            <th  width="5%">Unit</th>
                            <th width="4%">Status</th>
                            <th width="7%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.deleteProduct').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the product!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#f41127",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to the delete URL
                    window.location.href = deleteUrl;
                }
            });
            
        });
    });
</script>

@endsection


