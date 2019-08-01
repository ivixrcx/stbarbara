

/* global declarations */

$('#frm_add_house').validate({
  rules: {
    name: {
      required: true,
      maxlength: 50,
    },
    lot_area: {
      required: true,
      min: 30,
    },
    floor_area: {
      required: true,
      min: 50,
    },
    suggested_price: {
      required: true,
      min: 1000,
    },
  },

  messages: {
    name: {
      required: "This field is required",
      maxlength: "Max of 50 characters",
    },
    lot_area: {
      required: "This field is required",
      min: "Minimum of 30 sq.m.",
    },
    floor_area: {
      required: "This field is required",
      min: "Minimum of 50 sq.m.",
    },
    suggested_price: {
      required: "This field is required",
      min: "Minimum of 1,000",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'house/create',
      type: 'post',
      data: {
        name: $('#name').val(),
        lot_area: $('#lot_area').val(),
        floor_area: $('#floor_area').val(),
        suggested_price: $('#suggested_price').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='houses';
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