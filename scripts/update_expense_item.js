

/* global declarations */

$('form').validate({
  rules: {
    expense_item_id: {
      required: true,
    },
    description: {
      required: true,
      minlength: 3,
      maxlength: 50
    },
  },
  submitHandler: function(form){      
    $.post('expenseitem/update', $(form).serialize())
    .then(res=>{
      if(res.has_data){
        Swal.fire({
          type: 'success',
          showConfirmButton: false,
          timer: 2000
          })
          .then(()=>{
          window.location.href='expense-items';
        });
      }
      else{
        Swal.fire({
          type: 'error',
          title: 'Error',
          title: res.error_html
        });
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