

/* global declarations */
let suppliers = $('#supplier_id');

$('#frm_add_supplier').validate({
  rules: {
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
      url: 'supplier/create',
      type: 'post',
      data: {
        name: $('#name').val(),
        description: $('#description').val(),
        address: $('#address').val(),
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
            window.location.href='supplier/list_view';
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