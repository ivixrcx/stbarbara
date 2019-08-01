

/* global declarations */

$('#frm_add_stock_in').validate({
  rules: {
    warehouse_id: {
      required: true,
      digits: true,
    },
    stock_in_id: {
      required: true,
    },
    date: {
      required: true,
      date: true,
    },
    quantity: {
      required: true,
      number: true,
      min: 0.1,
      max: 999,
    },
    remarks: {
      maxlength: 150,
    },
  },

  messages: {
    warehouse_id: {
      required: "This field is required",
      digits: "Input integer only",
    },
    stock_in_id: {
      required: "This field is required",
    },
    date: {
      required: "This field is required",
      date: "Invalid date",
    },
    quantity: {
      required: "This field is required",
      min: "Minimum of 0.1",
      max: "Maximum of 999",
    },
    remarks: {
      maxlength: "Max of 150 characters",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'stock/create_stock_in',
      type: 'post',
      data: {
        warehouse_id: $('#warehouse_id').val(),
        stock_in_id: $('#stock_in_id').data('id'),
        date: $('#date').val(),
        quantity: $('#quantity').val(),
        remarks: $('#remarks').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='view/warehouse/' + $('#warehouse_id').val();
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

$("#stock_in_id").keyup(function(){

  let list = [];
  $.ajax({
    url: 'material/search',
    type: 'post',
    data: { search: $(this).val() },
    success: function(res){
      if(res.has_data){
        $.each(res.data, function( key, data ){
          list.push({
              id: data.material_id,
              data: data.particular
          });
        });

        autocomplete($("#stock_in_id"), list);
      }
    },
    error: function(err){
      console.log('error');
      console.log(err);
    },
  });


});

