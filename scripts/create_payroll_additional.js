

/* global declarations */

$('#frm_create_payroll_additional').validate({
  rules: {
    payroll_id: {
      required: true,
    },
    type_id: {
      required: true,
    },
    date: {
      required: true,
    },
    amount: {
      required: true,
    },
  },

  messages: {
    payroll_id: {
        required: "This field is required",
    },
    type_id: {
        required: "This field is required",
    },
    date: {
        required: "This field is required",
    },
    amount: {
        required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'payroll/create_payroll_additional_process',
      type: 'post',
      data: {
        payroll_id: $('#payroll_id').val(),
        type_id: $('#type_id').val(),
        date: $('#date').val(),
        amount: $('#amount').val(),
        note: $('#note').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='view/payroll-details/' + $('#payroll_id').val();
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