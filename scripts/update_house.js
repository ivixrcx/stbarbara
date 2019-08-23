

/* global declarations */

$('form').validate({
  rules: {
    house_id: {
      required: true,
      digit: true,
    },
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
    house_id: {
      required: "This field is required",
      digit: "Digits required.",
    },
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
    var house_id = $("#house_id").val();
    var name = $("#name").val();
    var lot_area = $("#lot_area").val();
    var floor_area = $("#floor_area").val();
    var suggested_price = $("#suggested_price").val();
    
    $.post("house/update", { 
        house_id: house_id,
        name: name,
        lot_area: lot_area,
        floor_area: floor_area,
        suggested_price: suggested_price,
    })
    .then(res=>{
        Swal.close();
        if(res.data){
            Swal.fire({
                type: 'success',
                timer: 1500,
                showConfirmButton: false,
            })
            .then(a=>window.location.href='houses');
        }
        else{
            Swal.fire({
                type: 'info',
                title: res.error,
                timer: 1500,
                showConfirmButton: false,
            })
        }
    })
    .catch(err=>{
        console.log(err)
        Swal.fire({
            type: 'error',
            title: err.statusText,
            timer: 2500,
            showConfirmButton: false,
        });
    });
  }

});