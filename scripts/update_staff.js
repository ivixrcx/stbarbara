

/* global declarations */

$('form').validate({
    rules: {
        last_name: {
          required: true,
        },
        first_name: {
          required: true,
        },
        address: {
          required: false,
        },
        contact_no: {
          required: false,
        },
        gender: {
          required: false,
        },
        birth_date: {
          required: false,
        },
        start_date: {
          required: false,
        },
        daily_compensation: {
          required: false,
        },
        daily_cola: {
          required: false,
        },
        job_description: {
          required: false,
        },
        sss: {
          required: false,
        },
        pagibig: {
          required: false,
        },
        tin: {
          required: false,
        },
      },
    
      messages: {
        last_name: {
            required: "This field is required",
        },
        first_name: {
            required: "This field is required",
        },
        address: {
            required: "This field is required",
        },
        contact_no: {
            required: "This field is required",
        },
        gender: {
            required: "This field is required",
        },
        birth_date: {
            required: "This field is required",
        },
        start_date: {
            required: "This field is required",
        },
        daily_compensation: {
            required: "This field is required",
        },
        daily_cola: {
            required: "This field is required",
        },
        job_description: {
            required: "This field is required",
        },
        sss: {
            required: "This field is required",
        },
        pagibig: {
            required: "This field is required",
        },
        tin: {
            required: "This field is required",
        },
      },

  submitHandler: function(form){
    $.ajax({
      url: 'staff/update_staff_process',
      type: 'post',
      data: {
        staff_id: $('#staff_id').val(),
        last_name: $('#last_name').val(),
        first_name: $('#first_name').val(),
        address: $('#address').val(),
        contact_no: $('#contact_no').val(),
        gender: $('#gender').val(),
        birth_date: $('#birth_date').val(),
        start_date: $('#start_date').val(),
        daily_compensation: $('#daily_compensation').val(),
        daily_cola: $('#daily_cola').val(),
        job_description: $('#job_description').val(),
        sss: $('#sss').val(),
        pagibig: $('#pagibig').val(),
        tin: $('#tin').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Success!.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='staffs';
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