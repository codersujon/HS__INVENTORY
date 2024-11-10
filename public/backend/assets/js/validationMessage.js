$(document).ready(function () {

    $('#supplierForm').validate({
        rules: {
            supplierN: {
                required: true,
            },
            contactP: {
                required: true,
            },
            mobile_no: {
                required: true,
            }
        },
        messages: {
            supplierN: {
                required: 'Enter Supplier Name',
            },
            contactP: {
                required: 'Enter Contact Person Name',
            },
            mobile_no: {
                required: 'Enter Mobile Number',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#customerForm').validate({
        rules: {
            customerN: {
                required: true,
            },
            c_phone: {
                required: true,
            },
            c_gender:{
                required: true,
            }
        },
        messages: {
            customerN: {
                required: 'Enter Customer Name',
            },
            c_phone: {
                required: 'Enter Mobile Number',
            },
            c_gender:{
                required: 'Select Gender',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#unitForm').validate({
        rules: {
            unit_name: {
                required: true,
            }
        },
        messages: {
            unit_name: {
                required: 'Enter Unit Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#CategoryForm').validate({
        rules: {
            cat_name: {
                required: true,
            }
        },
        messages: {
            cat_name: {
                required: 'Enter Category Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#shelfForm').validate({
        rules: {
            shelf_name: {
                required: true,
            }
        },
        messages: {
            shelf_name: {
                required: 'Please Enter Shelf Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#productForm').validate({
        rules: {
            productN: {
                required: true,
            },
            supplier_id: {
                required: true,
            },
            unit_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            p_qty: {
                required: true,
            },
            shelf_id:{
                required: true,
            }
        },
        messages: {
            productN: {
                required: 'Enter Product Name',
            },
            supplier_id: {
                required: 'Select Supplier Name',
            },
            unit_id: {
                required: 'Select Unit Name',
            },
            category_id: {
                required: 'Select Category Name',
            },
            p_qty: {
                required: 'Enter Product Quantity',
            },
            shelf_id:{
                required: 'Select Shelf Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#SearchSupplier').validate({
        rules: {
            supplier_id: {
                required: true,
            }
        },
        messages: {
            supplier_id: {
                required: 'Select Supplier Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    $('#SearchProduct').validate({
        rules: {
            category_id: {
                required: true,
            },
            product_id: {
                required: true,
            }
        },
        messages: {
            category_id: {
                required: 'Select Category Name',
            },
            product_id: {
                required: 'Select Product Name',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });

    

    $('#dailyIReport').validate({
        rules: {
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            }
        },
        messages: {
            start_date: {
                required: 'Start date is required',
            },
            end_date: {
                required: 'End date is required',
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
    

});
