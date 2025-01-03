$(document).ready(function(){

    // AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    /**
     * SHOW SHIPPING CHARGE
     */
    function shippingCharge(){
        $.ajax({
            url: "/shipping/charges",
            type: "GET",
            success: function(response){
                let rows = "";
                
                $.each(response.shippingcharges, function(key, val){

                    
                    rows += `
                        <tr>
                            <td class="text-center">${ key+1 }</td>
                            <td class="text-center">${val.title}</td>
                            <td class="text-center">${val.shipping_charge}</td>
                            <td class="text-center">
                                ${val.status == '1' ? 
                                    '<span class="badge bg-success"><i class="fadeIn animated bx bx-check-circle"></i> Active</span>' :
                                    '<span class="badge bg-danger"><i class="fadeIn animated bx bx-shield-x"></i> Inactive</span>'
                                }
                            </td>
                            <td>
                                <button class="btn btn-sm btn-dark EditShipping" data-bs-toggle="modal" data-bs-target="#EditShippingChargeModal" data-url="/shipping/edit/${val.id}">
                                    <i class="lni lni-pencil"></i>Edit
                                </button>

                                <button class="btn btn-sm btn-danger deleteCharge" data-url="/shipping/destroy/${val.id}">
                                    <i class="lni lni-trash"></i>Trash
                                </button>
                            </td>
                        </tr>
 
                    `;
                });
                
                $("#shippingTableBody").html(rows);
            }
        });
    }
    shippingCharge();

    /**
     * ADD SHIPPING CHARGE
     */

    $(document).on("click", "#StoreSCharge", function(event){
        event.preventDefault();

        let title  = $("#title").val();
        let shippingCharge  = $("#shippingCharge").val();

        $.ajax({
            url: "/shipping/store",
            type: "POST",
            data:{
                title: title,
                shipping_charge: shippingCharge
            },
            success: function(response){
                
                if(response.status == '200'){
                    $("#ShippingChargeModal").modal('hide');
                    $("#title").val("");
                    $("#shippingCharge").val("");

                    $("#shippingTableBody").append(`
                         <tr>
                            <td class="text-center">${response.totalRows }</td>
                            <td class="text-center">${response.shippingcharges.title}</td>
                            <td class="text-center">${response.shippingcharges.shipping_charge}</td>
                            <td class="text-center">
                                ${response.shippingcharges.status == '1' ? 
                                    '<span class="badge bg-success"><i class="fadeIn animated bx bx-check-circle"></i> Active</span>' :
                                    '<span class="badge bg-danger"><i class="fadeIn animated bx bx-shield-x"></i> Inactive</span>'
                                }
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#ShippingChargeModal"><i class="lni lni-pencil"></i>Edit</button>

                                <button class="btn btn-sm btn-danger deleteCharge" data-url="/shipping/destroy/${response.shippingcharges.id}">
                                    <i class="lni lni-trash"></i>Trash
                                </button>
                            </td>
                        </tr>
                    `);

                    Swal.fire({
                        text: response.message,
                        icon: 'success',
                        timer: 500,
                        showConfirmButton: true
                    });
                }
            },
            error: function(){
                Swal.fire({
                    text: "Failed to add shipping charge. Please try again.",
                    icon: 'error',
                    iconColor: '#f41127',
                    timer: 1500,
                    showConfirmButton: true,
                    confirmButtonColor: "#0d6efd",
                });
            }
        });
    });

    /**
     * EDIT SHPPING CHARGE
     */

    $(document).on("click", ".EditShipping", function(e){
        e.preventDefault();
        
        const EditUrl = $(this).data('url');

        $.ajax({
            url: EditUrl,
            type: "GET",
            dataType: "json", // Expect a JSON response
            success: function(response){
                console.log(response);
                if(response.status == '200'){
                    $("#sid").val(response.data.id);
                    $("#Etitle").val(response.data.title);
                    $("#EshippingCharge").val(response.data.shipping_charge);
                    $("#status").val(response.data.status);
                }
            }
        });
    });

    /**
     * UPDATE SHIPPING
     */
    $(document).on("click", "#UpdateShipping", function(e){
        e.preventDefault();

        let sid = $("#sid").val();
        let title  = $("#Etitle").val();
        let shippingCharge  = $("#EshippingCharge").val();
        let status  = $("#status").val();

        $.ajax({
            url: `/shipping/update/${sid}`,
            type: "POST",
            data:{
                title: title,
                shipping_charge: shippingCharge,
                status: status
            },
            success: function(response){
                if(response.status == '200'){
                    $("#EditShippingChargeModal").modal('hide');
                    $("#Etitle").val("");
                    $("#EshippingCharge").val("");
                    $("#status").val("");

                    Swal.fire({
                        text: response.message,
                        icon: 'success',
                        timer: 500,
                        showConfirmButton: true
                    });
                    window.location.reload();
                }
            }
        });

    });


    


    /**
     * DESTROY SHIPPING CHARGE
     */
    $(document).on("click", ".deleteCharge", function(e){
        e.preventDefault();

        const deleteUrl = $(this).data('url');
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the Shipping Charge!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0d6efd",
            cancelButtonColor: "#f41127",
            confirmButtonText: "Yes, delete it!",
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: "GET",
                    success: function(response){
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            timer: 500,
                            showConfirmButton: true
                        });
                        shippingCharge();
                    },
                    error: function(){
                        Swal.fire({
                            title: "Error!",
                            text: "There was a problem deleting the shipping charge.",
                            icon: "error",
                            confirmButtonColor: "#0d6efd",
                            iconColor: '#f41127'
                        });
                    }
                });
              
            }
          });

    })


});


$(function(){
    // APPROVED PURCHASE
    $(document).on("click","#approveBtn", function(e){
        e.preventDefault();
        var link = $(this).attr("href");

    })
});