

/* global declarations */

$('#frm_create_payroll').validate({
  rules: {
    staff_id: {
      required: true,
    },
    paydate: {
      required: true,
    },
    no_of_days: {
      required: true,
    },
  },

  messages: {
    staff_id: {
        required: "This field is required",
    },
    paydate: {
        required: "This field is required",
    },
    no_of_days: {
        required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'payroll/create_payroll_process',
      type: 'post',
      data: {
        staff_id: $('#staff_id').val(),
        paydate: $('#paydate').val(),
        no_of_days: $('#no_of_days').val(),
        project_id: $('#project_id').val(),
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