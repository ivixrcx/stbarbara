

/* global declarations */

$('#frm_create_payroll_ca').validate({
  rules: {
    staff_id: {
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
    staff_id: {
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
      url: 'payroll/create_cash_advance_process',
      type: 'post',
      data: {
        staff_id: $('#staff_id').val(),
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
            window.location.href='view/payroll/' + $('#staff_id').val();
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