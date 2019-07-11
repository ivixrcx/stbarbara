$(function(){

  /* global declarations */
  let total = 0;
  
  $('#quantity, #unit_price').keyup(function(){
    let quantity = $('#quantity').val();
    let unit_price = $('#unit_price').val();

    if(quantity !== '' && unit_price !== ''){
      total = (parseFloat(quantity) * parseFloat(unit_price)).toFixed(2);
      $('#total').val(total);
    }

  });

  /* validation */

  $('#frm_add_item').validate({
    rules: {
      purchase_order_id: {
        required: true,
        digits: true,
      },
      supplier_id: {
        required: true,
        number: true,
      },
      description: {
        required: true,
        minlength: 5,
        maxlength: 200,
      },
      quantity: {
        required: true,
        number: true,
        min: 0.1,
        max: 100,
      },
      unit_price: {
        required: true,
        number: true,
        min: 1,
      },
      total: {
        required: true,
        number: true,
        min: 1,
      },
    },

    messages: {
      supplier_id: {
        required: 'This field is required',
      },
      description: {
        required: 'This field is required',
        minlength: 'Minimum length of 5',
        maxlength: 'Maximum length of 100',
      },
      quantity: {
        required: 'This field is required',
        number: 'Input numbers only',
        min: 'Minimum value of 0.1',
        max: 'Maximum value of 100',
      },
      unit_price: {
        required: 'This field is required',
        number: 'Input numbers only',
        min: 'Minimum value of 1',
      },
      total: {
        required: 'This field is required',
        number: 'Input numbers only',
        min: 'Minimum value of 1',
      },
    },

    submitHandler: (form) => {

      $.ajax({
         type: 'post',
         url: 'purchaseorder/create_purchase_order_item',
         data: {
          purchase_order_id: $('#purchase_order_id').val(),
          quantity: $('#quantity').val(),
          description: $('#description').val(),
          unit_price: $('#unit_price').val(),
          total: total,
          supplier_id: $('#supplier_id').val(),
         },
         error: (err) => {
           console.log('error');
           console.log(error);
         },
         success: (res) => {
           if(res.has_data == true){
            Swal.fire({
              type: 'success',
              title: 'System message',
              text: 'Successfully added!',
              timer: 1500,
              showConfirmButton: false,
            })
            .then(function(){
              window.location.href='purchaseorder/purchase_order_item_view/' + $('#purchase_order_id').val();
            });
           }
         },
      });
    }

  });


});