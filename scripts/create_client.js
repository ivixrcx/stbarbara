

/* global declarations */

$('#frm_create_client').validate({
  rules: {
    last_name: {
      required: true,
    },
    first_name: {
      required: true,
    },
  },

  messages: {
    last_name: {
        required: "This field is required",
    },
    first_name: {
        required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'client/create_process',
      type: 'post',
      data: {

        // Personal Details
        last_name: $('#last_name').val(),
        first_name: $('#first_name').val(),
        middle_name: $('#middle_name').val(),
        birth_date: $('#birth_date').val(),
        birth_place: $('#birth_place').val(),
        gender: $('#gender').val(),
        civil_status: $('#civil_status').val(),
        religion: $('#religion').val(),
        nationality: $('#nationality').val(),
        tin: $('#tin').val(),
        sss: $('#sss').val(),
        pagibig: $('#pagibig').val(),
        drivers_license: $('#drivers_license').val(),
        occupation: $('#occupation').val(),

        // Spouse Details
        spouse_last_name: $('#spouse_last_name').val(),
        spouse_first_name: $('#spouse_first_name').val(),
        spouse_middle_name: $('#spouse_middle_name').val(),
        spouse_birth_date: $('#spouse_birth_date').val(),
        spouse_birth_place: $('#spouse_birth_place').val(),
        spouse_occupation: $('#spouse_occupation').val(),
        spouse_nationality: $('#spouse_nationality').val(),
        spouse_sss: $('#spouse_sss').val(),
        spouse_tin: $('#spouse_tin').val(),
        spouse_pagibig: $('#spouse_pagibig').val(),
        spouse_drivers_license: $('#spouse_drivers_license').val(),
        spouse_id_name: $('#spouse_id_name').val(),
        spouse_id_no: $('#spouse_id_no').val(),
        spouse_id_date_issued: $('#spouse_id_date_issued').val(),
        spouse_id_place_issued: $('#spouse_id_place_issued').val(),

        // Contact Information
        residence_address: $('#residence_address').val(),
        provincial_address: $('#provincial_address').val(),
        landline_no: $('#landline_no').val(),
        cellphone_no: $('#cellphone_no').val(),
        email: $('#email').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='client'
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