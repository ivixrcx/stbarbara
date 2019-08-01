

/* global declarations */

$('#frm_add_warehouse').validate({
  rules: {
    name: {
      required: true,
      maxlength: 20,
    },
    location: {
      required: true,
      maxlength: 20,
    },
    contact_no: {
      required: true,
      maxlength: 20,
    },
  },

  messages: {
    name: {
      required: "This field is required",
      maxlength: "Max of 20 characters",
    },
    location: {
      required: "This field is required",
      maxlength: "Max of 20 characters",
    },
    contact_no: {
      required: "This field is required",
      maxlength: "Max of 20 characters",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'warehouse/create',
      type: 'post',
      data: {
        name: $('#name').val(),
        location: $('#location').val(),
        contact_no: $('#contact_no').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='warehouses';
          });
        }
        
      },
      error: function(err){
        console.log('error');
        console.log(err);
      },
    });
  }

});