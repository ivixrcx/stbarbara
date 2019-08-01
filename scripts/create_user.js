

/* global declarations */

$.ajax({
  url: 'account/list_of_user_types',
  type: 'post',
  complete: function(res){
    $.each(res.responseJSON.data, function(key, value){
      $('select[name=user_role]').append( new Option(value.name, value.user_type_id) );
    });
  },
  error: function(error){
    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})

$('#frm_create_user').validate({
  rules: {
    last_name: {
      required: true,
      maxlength: 20,
    },
    first_name: {
      required: true,
      maxlength: 20,
    },
    user_name: {
      required: true,
      maxlength: 20,
    },
    password: {
      required: true,
      minlength: 8,
      maxlength: 20,
    },
    r_password: {
      required: true,
      minlength: 8,
      maxlength: 20,
      equalTo: "#password",
    },
    privilege: {
      required: true,
    },
  },

  messages: {
    last_name: {
      required: "Please enter your Last name",
      maxlength: "Max of 20 characters",
    },
    first_name: {
      required: "Please enter your First name",
      maxlength: "Max of 20 characters",
    },
    user_name: {
      required: "Please enter your User name",
      maxlength: "Max of 20 characters",
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 8 characters long",
      maxlength: "Max of 20 characters",
    },
    r_password: {
      required: "Please Provide a password",
      minlength: "Your password must be at least 8 characters long",
      maxlength: "Max of 20 characters",
      equalTo: "Password Mismatch",
    },
    privilege: {
      required: "Please Choose User Role",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'account/create_user_process', 
      type: 'POST',
      data: $(form).serialize(), 
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='users';
          });
        }
        
      },
      error: function(err){
        console.log('error');
        console.log(err);
      }

    })
  }
})