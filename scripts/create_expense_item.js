

/* global declarations */

$('#form').validate({
  rules: {
    categoryId: {
      required: true,
    },
    category: {
      required: true,
      maxlength: 50,
    },
    item: {
      required: true,
      maxlength: 50,
    }
  },

  submitHandler: function(form){
    $.post('expenseitem/create', $(form).serialize())
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
      console.log('error', err);
      throw 'error: ' + err;
    });
  }

});


$(function(){
  let ac = new autocomplete($('#category'));
  // request
  $.post('expensecategory/list')
  // jQuery promise
  .then(res=>{
    var list = [];
    // populate list[];
    $.each(res.data, (e, data)=>{
    console.log(data)
      
      list.push({
        id: data.expense_category_id,
        data: data.category_name,
      });
    });
    // pass list[] to setData() that serves as the items for the dropdown.
    ac.setData(list);
  });

  ac.itemSelected((id,val,input)=>{
    $('#categoryId').val(id);
  });
});

