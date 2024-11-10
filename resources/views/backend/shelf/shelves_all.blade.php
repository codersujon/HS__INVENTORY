@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Shelves</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Shelf</li>
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
                    <a href="{{ route('shelves.create') }}" class="btn btn-primary radius-30"><i class="bx bxs-plus-square"></i>Add Shelf</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Shelves Name</th>
                            <th width="10%">Capacity</th>
                            <th>Description</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($shelves as $key => $shelf)
                            <tr>
                                <td>{{ $key+1; }}</td>
                                <td>{{ $shelf->shelves_name }}</td>
                                <td>{{ $shelf->capacity }}</td>
                                <td>{{ $shelf->description }}</td>
                                <td class="text-center">
                                     @if ($shelf->status == "1")
                                     <span class="badge bg-success">Active</span>
                                     @else
                                        <span class="badge bg-danger">Inactive</span>
                                     @endif
                                </td>
                                <td>
                                    <a href="{{ route('shelves.edit', $shelf->id) }}" class="btn btn-sm btn-dark"><i class="lni lni-pencil"></i>Details</a>
                                    <a href="{{ route('shelves.delete', $shelf->id) }}" class="btn btn-sm btn-danger"><i class="lni lni-trash"></i>Trash</a>
                                </td>
                            </tr>


                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">#SN</th>
                            <th>Shelves Name</th>
                            <th width="10%">Capacity</th>
                            <th>Description</th>
                            <th width="5%">Status</th>
                            <th width="8%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


