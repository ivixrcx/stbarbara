

/* global declarations */

$('form').validate({
  rules: {
    supplier_id: {
      required: true,
      digit: true,
    },
    name: {
      required: true,
    },
    address: {
      required: true,
    },
    contact_no: {
      required: true,
    },
  },

  messages: {
    supplier_id: {
      required: "This field is required",
      digit: 'Digit required.',
    },
    name: {
      required: "This field is required",
    },
    address: {
      required: "This field is required",
    },
    contact_no: {
      required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'supplier/update',
      type: 'post',
      data: {
        supplier_id: $('#supplier_id').val(),
        name: $('#name').val(),
        description: $('#description').val(),
        address: $('#address').val(),
        contact_no: $('#contact_no').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Success!.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='suppliers';
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