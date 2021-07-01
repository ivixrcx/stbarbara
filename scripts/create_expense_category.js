

/* global declarations */

$('#form').validate({
  rules: {
    description: {
      required: true,
      minlength: 3,
      maxlength: 45,
    },

    messages: {
      description: {
        required: "This field is required",
        minlength: "Max of 3 characters",
        maxlength: "Max of 45 characters",
      },
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'expensecategory/create',
      type: 'post',
      data: {
        description: $('#description').val()
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='expense-categories';
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
