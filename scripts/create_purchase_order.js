

/* global declarations */
let suppliers = $('#supplier_id');

$('#frm_create_purchase_order').validate({
  rules: {
    project_id: {
      required: true,
    },
    supplier_id: {
      required: true,
    },
    requested_by: {
      required: true,
    },
    requested_date: {
      required: true,
      date: true,
    },
  },

  messages: {
    project_id: {
      required: "Please choose a Project",
    },
    supplier_id: {
      required: "Please choose a Vendor",
    },
    requested_by: {
      required: "This field is required",
    },
    requested_by: {
      required: "This field is required",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'purchaseorder/create_purchase_order',
      type: 'post',
      data: {
        project_id: $('#project_id').val(),
        supplier_id: $('#supplier_id').val(),
        requested_by: $('#requested_by').data('id'),
        requested_date: $('#requested_date').val(),
        user_note: $('#user_note').val(),
      },
      complete: function(res){
        if(res.responseJSON.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='purchase-order-items/' + res.responseJSON.data;
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

$.ajax({
  type: 'post',
  url: 'supplier/list',
  error: (err) => {
    console.log('error');
    console.log(err);
  },
  success: (res) => {
    if(res.has_data == true){
      // let options = 
      $.each(res.data, function(key, data){
       $(suppliers).append(new Option(data.name, data.supplier_id));
      });
    }
   else{
     $(suppliers).append(new Option('---No suppliers available---', 0));
   }
  },
});

$.ajax({
  url: 'purchaseorder/active_projects',
  type: 'post',
  success: function(res){
    // console.log('success');
    if(res.has_data){
      $.each(res.data, function( key, data ){
        $('#project_id').append( new Option( data.name, data.project_id ) );
      });
    }
    else{
      // no projects
      $('#project_id').append( new Option('NO PROJECT') );

    }
  },
  error: function(err){
    console.log('error');
    console.log(err);
  },
});

let aaa = [];
$.ajax({
  url: 'purchaseorder/active_staffs',
  type: 'post',
  success: function(res){
    // console.log('success');
    if(res.has_data){
      $.each(res.data, function( key, data ){
        aaa.push({
            id: data.user_id,
            data: data.full_name
        });
      });
    }
    else{
      // no staffs
    }
  },
  error: function(err){
    console.log('error');
    console.log(err);
  },
});

console.log(aaa)
// return

autocomplete($("#requested_by"), aaa);