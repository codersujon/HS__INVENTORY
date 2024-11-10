@extends('backend.master')

@section('main-content')

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Customer</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Customer</li>
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
                        <h5 class="mb-0 text-primary">Add Customer</h5>
                    </div>
                    <hr>
                    <form class="row g-3" id="customerForm" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="customerN" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customerN" id="customerN"
                                placeholder="Customer Name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="c_dob" class="form-label">Date of Birth</label>
                            <input type="text" class="form-control datepicker picker__input picker__input--active" name="c_dob" id="c_dob" placeholder="Ex: 4 June, 2024">
                        </div>

                        <div class="form-group col-6">
                            <label for="c_phone" class="form-label">Mobile No</label>
                            <input type="tel" class="form-control" name="c_phone" id="c_phone" minlength="11"
                                maxlength="11" placeholder="Ex: 01680******">
                        </div>

                        <div class="form-group col-6">
                            <label for="c_email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="c_email" id="c_email"
                                placeholder="Email Address">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="c_gender" class="form-label">Gender</label>
                            <select name="c_gender" id="c_gender" class="form-control">
                                <option value="">--Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="c_image" class="form-label">Customer Image</label>
                            <input type="file" class="form-control" name="c_image" id="c_image">
                        </div>

                        <div class="form-group col-12 ">
                            <img src="{{ (!empty($adminData->profile_image))? url('upload/profile/'.$adminData->profile_image): url('upload/No_Image.jpg') }}" class="p-1 rounded-circle" al t="user avatar" width="110" id="showImage">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary px-5" id="save_supplier">Save Customer</button>
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
        $("#c_image").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#showImage").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
