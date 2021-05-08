

/* global declarations */

$('#frm_change_pwd').submit(function(e) {
    e.preventDefault();
}).validate({
  rules: {
    current_pwd: {
      required: true,
    },
    new_pwd: {
      required: true,
    },
    rnew_pwd: {
      required: false,
    },
  },

  messages: {
    current_pwd: {
        required: "This field is required",
    },
    new_pwd: {
        required: "This field is required",
    },
    rnew_pwd: {
        required: "This field is required",
    },
  },

  submitHandler: function(form){
    // if new password is matched
    const np = $('#new_pwd').val();
    const rnp = $('#rnew_pwd').val();

    if(np !== rnp)
    {
        return Swal.fire({
            type: 'error',
            title: 'New password does not matched!',
            showConfirmButton: false,
            timer: 1500,
        })
    }

    $.ajax({
      url: 'account/change_pwd_process',
      type: 'post',
      data: {
        user_id: $('#user_id').val(),
        current_pwd: $('#current_pwd').val(),
        new_pwd: $('#new_pwd').val(),
      },
      success: function(res){
        if(res.has_data === true){
          return Swal.fire({
            type: 'success',
            title: 'Sucessfully changed!',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='home';
          });
        }
        else{            
          return Swal.fire({
            type: 'error',
            title: 'Invalid current password!',
            showConfirmButton: false,
            timer: 1500,
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