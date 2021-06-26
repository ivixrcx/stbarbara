

/* global declarations */

$('form').validate({
    rules: {
        name: {
            required: true,
            maxlength: 100,
        },
        location: {
            required: true,
            maxlength: 100,
        },
        contact_no: {
            required: true,
            maxlength: 20,
        },
    },

    messages: {
        name: {
            required: "This field is required",
            maxlength: "Max of 100 characters",
        },
        location: {
            required: "This field is required",
            maxlength: "Max of 100 characters",
        },
        contact_no: {
            required: "This field is required",
            maxlength: "Max of 20 characters",
        },
    },

    submitHandler: function(form){        
        $.post("warehouse/update", { 
            warehouse_id: $('#warehouse_id').val(),
            name: $('#name').val(),
            location: $('#location').val(),
            contact_no: $('#contact_no').val(),
        })
        .then(res=>{
            Swal.close();
            if(res.data){
                Swal.fire({
                    type: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                })
                .then(a=>window.location.href='warehouses');
            }
            else{
                Swal.fire({
                    type: 'info',
                    title: res.error,
                    timer: 1500,
                    showConfirmButton: false,
                })
            }
        })
        .catch(err=>{
            console.log(err)
            Swal.fire({
                type: 'error',
                title: err.statusText,
                timer: 2500,
                showConfirmButton: false,
            });
        });
    }

});