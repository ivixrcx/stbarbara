

/* global declarations */

$('form').validate({
  rules: {
    particular: {
      required: true,
      minlength: 3,
      maxlength: 50,
    },
    priority_level: {
      required: true,
      min: 1,
      max: 10
    },
  },
  submitHandler: function(form){
    // checking if material exists
    let particular = $('#particular').val();
    let priority_level = $('#priority_level').val();

    $.post('materialcategory/search_particular_unit', {
      particular: particular
    })
    .then(res=>{
      if(res.data.length){
        Swal.fire({
          type: 'error',
          html: `Category "<b>${particular}</b>" exists.`,
        });
      }
      else{
        $.post('materialcategory/update', $(form).serialize())
        .then(res=>{
            if(res.has_data){
              Swal.fire({
                type: 'success',
                showConfirmButton: false,
                timer: 2000
              })
              .then(()=>{
                window.location.href='materials-category';
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
          console.log('error', err);
          throw 'error: ' + err;
        });
      }
    })
    .catch(err=>{
      console.log('error', err);
      throw 'error: ' + err;
    });
  }
});