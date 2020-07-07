

/* global declarations */

$('#form').validate({
  rules: {
    category_id: {
      required: true,
    },
    item_id: {
      required: true,
    },
    category: {
      required: true,
      minlength: 3,
      maxlength: 50,
    },
    item: {
      required: true,
      minlength: 3,
      maxlength: 50,
    },
    amount: {
      required: true,
      min: 0,
    },
  },

  messages: {
    category: {
      required: "This field is required",
      maxlength: "Max of 100 characters",
    },
    item: {
      required: "This field is required",
      maxlength: "Max of 50 characters",
    },
    amount: {
      required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.post('expense/create', $(form).serialize())
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


$(function(){
  let ac = new autocomplete($('#category'));
  
  $.post('expensecategory/list')
  .then(res=>{
    var list = [];
    // populate list[];
    $.each(res.data, (e, data)=>{
      
      list.push({
        id: data.expense_category_id,
        data: data.description,
      });
    });
    // pass list[] to setData() that serves as the items for the dropdown.
    ac.setData(list);
  });

  // callback when item is selected.
  ac.itemSelected((id, val, input)=>{
    $('#category_id').val(id);

    let ac = new autocomplete($('#item'));
    
    $.post(`expenseitem/list_by_category/${id}`)
    .then(res=>{
      var list = [];
      // populate list[];
      $.each(res.data, (e, data)=>{
        list.push({
          id: data.expense_item_id,
          data: data.description,
        });
      });
      // pass list[] to setData() that serves as the items for the dropdown.
      ac.setData(list);
    });

    ac.itemSelected((id, val, input)=>{
      $('#item_id').val(id);
    });
  });
});

