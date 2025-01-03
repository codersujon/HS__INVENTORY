@extends('backend.master')

@section('main-content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Courier API</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">General Setting</li>
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
                    <div class="col-12">
                        <div class="card-body">
                            <div class="p-4 border rounded">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h4 class="mb-0 text-primary">Steadfast Courier</h4>
                                </div>
                                <hr>
                                <form class="row g-3 needs-validation" action="{{ route('courier.api.update', $steadfast->id) }}" method="POST">
                                    @csrf

                                    {{-- API Key --}}
                                    <div class="form-group col-md-6">
                                        <label for="api_key" class="form-label">API Key <span>*</span></label>
                                        <input type="text" class="form-control" name="api_key" id="api_key" placeholder="API Key" value="{{ $steadfast->api_key }}">
                                    </div>

                                    {{-- Secret Key --}}
                                    <div class="form-group col-md-6">
                                        <label for="secret_key" class="form-label">Secret Key <span>*</span></label>
                                        <input type="text" class="form-control" name="secret_key" id="secret_key" placeholder="Secret Key" value="{{ $steadfast->secret_key }}">
                                    </div>

                                    {{-- URL --}}
                                    <div class="form-group col-md-12">
                                        <label for="url" class="form-label">URL <span>*</span></label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="Type URL" value="{{ $steadfast->url }}">
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $steadfast->status == 1 ? 'checked' : '' }} checked>
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        {{-- <a href="" class="btn btn-outline-primary radius-30 SteadFast" id="SteadFast">
                            <i class="bx bx-right-arrow mt-0"></i> Submit
                        </a> --}}
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection