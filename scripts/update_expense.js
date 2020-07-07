
/* global declarations */

$('form').validate({
  rules: {
    expenseId: {
      required: true,
      maxlength: 100,
    },
    amount: {
      required: true,
    },
  },

  messages: {
    category: {
      required: "This field is required",
      maxlength: "Max of 100 characters",
    },
    amount: {
      required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.post('expense/update', $(form).serialize())
    .then(res=>{
        if(res.has_data){
          Swal.fire({
            type: 'success',
            showConfirmButton: false,
            timer: 2000
          })
          .then(()=>{
            window.location.href='expenses';
          });
        }
        else{
          Swal.fire({
              type: 'info',
              title: res.error,
              timer: 1500,
              showConfirmButton: false,
          })
        }
    })
    .catch(err=>{
      Swal.fire({
        type: 'error',
        title: 'Error',
        title: err
      });
    });
  }

});