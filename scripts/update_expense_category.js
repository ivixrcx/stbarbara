

/* global declarations */

$('form').validate({
  rules: {
    expense_category_id: {
      required: true,
    },
    description: {
      required: true,
      minlength: 3,
      maxlength: 100,
    },
  },

  submitHandler: function(form){
    $.post('expensecategory/update', $(form).serialize())
    .then(res=>{
      if(res.has_data){
        Swal.fire({
          type: 'success',
          showConfirmButton: false,
          timer: 2000
        })
        .then(()=>{
          window.location.href='expense-categories';
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