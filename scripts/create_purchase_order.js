

/* global declarations */
let suppliers = $('#supplier_id');

$('#frm_create_purchase_order').validate({
  rules: {
    warehouse_id: {
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
    warehouse_id: {
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
    $.post('purchaseorder/create_purchase_order', {
      warehouse_id: $('#warehouse_id').val(),
      supplier_id: $('#supplier_id').val(),
      requested_by: $('#requested_by').data('id'),
      requested_date: $('#requested_date').val(),
      user_note: $('#user_note').val(),
    })
    .then(res=>{
      if(res.has_data){
        let id = res.data;
        Swal.fire({
          type: 'success',
          title: 'Successfully created.',
          showConfirmButton: false,
          timer: 1500,
        }).then(function(){
          window.location.href=`purchase-order-items/${id}`;
        });
      }
    })
    .catch(err=>{                
      Swal.showValidationMessage(err.responseJSON.error)
    });
  }

});

/**
 * get active warehouses
 */
$.post('purchaseorder/active_warehouses')
.then(res=>{
  if(res.has_data){
    $.each(res.data, function( key, data ){
      $('#warehouse_id').append( new Option( data.name, data.warehouse_id ) );
    });
  }
  else{
    // no warehouse
    $('#warehouse_id').append( new Option('---NO WAREHOUSE---') );
  }
})
.catch(err=>{                
  Swal.showValidationMessage(err.responseJSON.error)
});

/**
 * get active suppliers
 */
$.post('purchaseorder/active_suppliers')
.then(res=>{
  if(res.has_data){
    $.each(res.data, function( key, data ){
      $('#supplier_id').append( new Option( data.name, data.supplier_id ) );
    });
  }
  else{
    // no suppliers
    $('#supplier_id').append( new Option('---NO SUPPLIER---') );
  }
})
.catch(err=>{                
  Swal.showValidationMessage(err.responseJSON.error)
});

/**
 * get active suppliers
 */

$.post('purchaseorder/active_staffs')
.then(res=>{
  if(res.has_data){
    let ls = [];
    $.each(res.data, function( key, data ){
      ls.push({
          id: data.user_id,
          data: data.full_name
      });
    });
    new autocomplete($("#requested_by"), ls);
  }
  else{
    // no data
  }
})
.catch(err=>{                
  Swal.showValidationMessage(err.responseJSON.error)
});