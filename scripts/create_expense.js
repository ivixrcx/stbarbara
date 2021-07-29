
// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

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


// $(function(){

//   // check if category input is null
//   $("#category").on('keyup', function(e){
//     var val = $(this).val()

//     if(val === ""){
//       $("#category_id").val('')
//       console.log($("#category_id").val())
//     }
//   })

//   // check if item input is null
//   $("#item").on('keyup', function(e){
//     var val = $(this).val()

//     if(val === ""){
//       $("#item_id").val('')
//       console.log($("#item_id").val())
//     }
//   })

//   // callback when item is selected.
//   ac.itemSelected((id, val, input)=>{
//     $('#category_id').val(id);

//     let ac = new autocomplete($('#item'));
    
//     $.post(`expenseitem/list_by_category/${id}`)
//     .then(res=>{
//       var list = [];
//       // populate list[];
//       $.each(res.data, (e, data)=>{
//         list.push({
//           id: data.expense_item_id,
//           data: data.description,
//         });
//       });
//       // pass list[] to setData() that serves as the items for the dropdown.
//       ac.setData(list);
//     });

//     ac.itemSelected((id, val, input)=>{
//       $('#item_id').val(id);
//     });
//   });
// });

// $(function(){

//   // check if project input is null
//   $("#project").on('keyup', function(e){
//     var val = $(this).val()

//     if(val === ""){
//       $("#project_id").val('')
//     }
//   })

//   let ac = new autocomplete($('#project'));
  
//   $.post('project/list')
//   .then(res=>{
//     var list = [];
//     // populate list[];
//     $.each(res.data, (e, data)=>{
      
//       list.push({
//         id: data.project_id,
//         data: data.name,
//       });
//     });
//     // pass list[] to setData() that serves as the items for the dropdown.
//     ac.setData(list);
//   });

//   // callback when item is selected.
//   ac.itemSelected((id, val, input)=>{
//     $('#project_id').val(id);
//   });
// });


//


var populate = function(e, i, n){
  $('.modal').modal('hide')

  $('#' + i).val($(e).data('id'))
  $('#' + n).val($(e).data('name'))
}

// category
$(function(){
  
  $('#category').on('click', function(){

    $('#list_category').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'expensecategory/list_ss',
        type: 'post',
        complete: function(res){
          let access = res.responseJSON.data;
          if(access.code == 101){ // no permission
              $('#list_category_wrapper').html(access.error_html);
          }
          else{
            new deletion({
                button: 'button.btndelete',
                action: 'expensecategory/delete',
                redirect: 'expenses'
            })
            .fire();
          }
        },
        error: function(error){
          // Swal.fire(error.responseText);
          console.log('error');
          console.log(error.responseText);
          // alert(error.responseText);
        },
      },
      columns: [
        {data: 'category_name'},
      ],
      columnDefs: [
        { 
          targets: 1,
          render: function(data, type, row){
            let buttons = `<div class="d-flex justify-content-end">`;
            buttons += `<button type="button" class="btn btn-secondary btn-sm" data-id="${row['expense_category_id']}" data-name="${row['category_name']}" onclick="populate(this, 'category_id', 'category')" btn-sm mr-2"><i class="fa fa-check text-dark"></i></button>`;
            buttons += `</div>`;
            return buttons;
          }
        },
      ]
    });
    
  })

});

// projects
$(function(){
  
  $('#project').on('click', function(){

    $('#list_project').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'project/list_ss',
        type: 'post',
        complete: function(res){
          let access = res.responseJSON.data;
          if(access.code == 101){ // no permission
              $('#list_category_wrapper').html(access.error_html);
          }
          else{
            new deletion({
                button: 'button.btndelete',
                action: 'project/delete',
                redirect: 'expenses'
            })
            .fire();
          }
        },
        error: function(error){
          // Swal.fire(error.responseText);
          console.log('error');
          console.log(error.responseText);
          // alert(error.responseText);
        },
      },
      columns: [
        {data: 'name'},
      ],
      columnDefs: [
        { 
          targets: 1,
          render: function(data, type, row){
            let buttons = `<div class="d-flex justify-content-end">`;
            buttons += `<button type="button" class="btn btn-secondary btn-sm" data-id="${row['project_id']}" data-name="${row['name']}" onclick="populate(this, 'project_id', 'project')" btn-sm mr-2"><i class="fa fa-check text-dark"></i></button>`;
            buttons += `</div>`;
            return buttons;
          }
        },
      ]
    });
    
  })

});

$(function(){
  $(".btn-clear").on('click', function(el){
    for(var i=0; i < $(this).parent().find('input').length; i++) {
      $($(this).parent().find('input')[i]).val('');
    }
  });
});