$(document).ready(function(){

    // AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * ADD SUPPLIER
     */

    // $(document).on("click", "#save_supplier", function(event){
    //     event.preventDefault();

    //     $.ajax({
    //         url: "/supplier/store",
    //         type: "POST",
    //         data: $("#supplierForm").serialize(),
    //         dataType: "JSON",
    //         success: function(response){
    //            if(response.status == 200){
    //                 $("#addSupplierModal").modal("hide");
    //                 window.location.reload();
    //            }
    //         }
    //     });

    // });


});


$(function(){
    // APPROVED PURCHASE
    $(document).on("click","#approveBtn", function(e){
        e.preventDefault();
        var link = $(this).attr("href");

    })
});