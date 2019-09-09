

/* global declarations */

$('form').validate({
  rules: {
    particular: {
      required: true,
      maxlength: 50,
    },
    unit: {
      required: true,
    },
    stock_level: {
      required: true,
      min: 1,
    },
  },
  submitHandler: function(form){
    // checking if material exists
    let particular = $('#particular').val();
    let unit = $('#unit').val();

    $.post('material/search_particular_unit', {
      particular: particular,
      unit: unit
    })
    .then(res=>{
      if(res.data.length){
        Swal.fire({
          type: 'error',
          html: `Material "<b>${particular}/${unit}</b>" exists.`,
        });
      }
      else{
        $.post('material/create', $(form).serialize())
        .then(res=>{
            if(res.has_data){
              Swal.fire({
                type: 'success',
                showConfirmButton: false,
                timer: 2000
              })
              .then(()=>{
                window.location.href='materials';
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

$.post('materialcategory/list')
.then(res=>{
    let input = $('#material_category');
    let list = [];

    if( res.data != '' ){
        $.each(res.data, (k,data)=>{
            list.push({
                id: data.material_category_id,
                data: data.particular,
            })
        });

        let ac = new autocomplete( input, list)        
        ac.itemSelected((id,val,input)=>{
          $('#material_category_id').val(id);
        });
    }
    else{
        $(input)
        .val('--- NO DATA ---')
        .attr('readonly', true);
    }
})
.catch(err=>{
  console.log('error', err);
  throw 'error: ' + err;
});
