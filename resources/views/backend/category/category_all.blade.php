@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
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
                    <a href="{{ route('category.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Category</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $categroy)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $categroy->category_name }}</td>
                                <td>{{ $categroy->category_des }}</td>
                                <td class="text-center">
                                    @if ($categroy->status == "1")
                                    <span class="badge bg-success">Active</span>
                                    @else
                                       <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', $categroy->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Edit</a>
                                    <button class="btn btn-sm btn-danger deleteCategory" data-url="{{ route('category.delete', $categroy->id) }}">
                                        <i class="lni lni-trash"></i>Trash
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll('.deleteCategory').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the category!",
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
