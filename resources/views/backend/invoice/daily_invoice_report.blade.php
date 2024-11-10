@extends('backend.master')

@section('main-content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Daily Invoice Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="p-5 border rounded">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h4>Search Daily Invoice Report</h4>
                            </div>
                        </div>
                        <div class="row">
                            <form action="{{ route('daily.invoice.pdf') }}"method="GET" target="_blank" id="dailyIReport">
                                <div class="row">
                                    {{-- Start date --}}
                                    <div class="form-group col-md-4 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="text" class="form-control datepicker" id="start_date" name="start_date"
                                            placeholder="Start Date" />
                                    </div>
                                    {{-- Ending date --}}
                                    <div class="form-group col-md-4 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="text" class="form-control datepicker" id="end_date"  name="end_date"
                                            placeholder="End Date" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-danger px-4"
                                            style="margin-top:29px;">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
