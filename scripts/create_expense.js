

/* global declarations */

$('#form').validate({
  rules: {
    category_id: {
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

  // check if category input is null
  $("#category").on('keyup', function(e){
    var val = $(this).val()

    if(val === ""){
      $("#category_id").val('')
      console.log($("#category_id").val())
    }
  })

  // check if item input is null
  $("#item").on('keyup', function(e){
    var val = $(this).val()

    if(val === ""){
      $("#item_id").val('')
      console.log($("#item_id").val())
    }
  })

  let ac = new autocomplete($('#category'));
  
  $.post('expensecategory/list')
  .then(res=>{
    var list = [];
    // populate list[];
    $.each(res.data, (e, data)=>{
      
      list.push({
        id: data.expense_category_id,
        data: data.category_name,
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

$(function(){

  // check if project input is null
  $("#project").on('keyup', function(e){
    var val = $(this).val()

    if(val === ""){
      $("#project_id").val('')
    }
  })

  let ac = new autocomplete($('#project'));
  
  $.post('project/list')
  .then(res=>{
    var list = [];
    // populate list[];
    $.each(res.data, (e, data)=>{
      
      list.push({
        id: data.project_id,
        data: data.name,
      });
    });
    // pass list[] to setData() that serves as the items for the dropdown.
    ac.setData(list);
  });

  // callback when item is selected.
  ac.itemSelected((id, val, input)=>{
    $('#project_id').val(id);
  });
});