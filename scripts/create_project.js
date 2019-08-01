

/* global declarations */

$('#frm_add_project').validate({
  rules: {
    name: {
      required: true,
      maxlength: 50,
    },
    total_area: {
      required: true,
      min: 50,
    },
    total_units: {
      required: true,
      min: 1,
      max: 999,
    },
    location: {
      required: true,
      maxlength: 100,

    },
  },

  messages: {
    name: {
      required: "This field is required",
      maxlength: "Max of 50 characters",
    },
    total_area: {
      required: "This field is required",
      min: "Minimim of 50 sq.m.",
    },
    total_units: {
      required: "This field is required",
      min: "Minimum of 1 unit",
      max: "Maximum of 999 units",
    },
    location: {
      required: "This field is required",
      maxlength: "Max of 100 characters",
    },
  },

  submitHandler: function(form){
    $.ajax({
      url: 'project/create',
      type: 'post',
      data: {
        name: $('#name').val(),
        total_area: $('#total_area').val(),
        total_units: $('#total_units').val(),
        location: $('#location').val(),
      },
      success: function(res){
        if(res.has_data === true){
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function(){
            window.location.href='projects';
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