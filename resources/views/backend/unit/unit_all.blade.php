@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Unit</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Unit</li>
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
                    <a href="{{ route('unit.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Unit</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Unit Name</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $key => $unit)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ strtoupper($unit->name) }}</td>
                                <td class="text-center">
                                    @if ($unit->status == "1")
                                    <span class="badge bg-success">Active</span>
                                    @else
                                       <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Edit</a>
                                    <button class="btn btn-sm btn-danger deleteUnit" data-url="{{ route('unit.delete', $unit->id) }}">
                                        <i class="lni lni-trash"></i>Trash
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Unit Name</th>
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
    document.querySelectorAll('.deleteUnit').forEach(function(deleteButton){
        
        deleteButton.addEventListener('click', function(e){
            e.preventDefault();
            
            const deleteUrl = this.getAttribute('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete the unit!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
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
