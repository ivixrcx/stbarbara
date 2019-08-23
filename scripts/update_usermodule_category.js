

/* global declarations */

$('form').validate({
    rules: {
        user_module_category_id: {
          required: true,
          digit: true,
        },
        user_module_category_name: {
          required: true,
          maxlength: 20,
        },
    },
  
    messages: {
        user_module_category_id: {
            required: "This field is required",
            digit: "Digit input",
        },
        user_module_category_name: {
            required: "This field is required",
            maxlength: "Max of 20 characters",
        },
    },
  
    submitHandler: function (form) {
        var id = $("#user_module_category_id").val();
        var name = $("#user_module_category_name").val();
        
        $.post("usermodulecategory/update", { 
            user_module_category_id: id,
            user_module_category_name: name
        })
        .then(res=>{
            Swal.close();
            if(res.data){
                Swal.fire({
                    type: 'success',
                    timer: 1500,
                    showConfirmButton: false,
                })
                .then(a=>window.location.href='module-category');
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