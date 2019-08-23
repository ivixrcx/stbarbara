

/* global declarations */

$('form').validate({
  rules: {
    project_id: {
      required: true,
      digit: true,
    },
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
    project_id: {
      required: "This field is required",
      digit: "Digits required.",
    },
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
    var project_id = $("#project_id").val();
    var name = $("#name").val();
    var total_area = $("#total_area").val();
    var total_units = $("#total_units").val();
    var location = $("#location").val();
    
    $.post("project/update", { 
        project_id: project_id,
        name: name,
        total_area: total_area,
        total_units: total_units,
        location: location,
    })
    .then(res=>{
        Swal.close();
        if(res.data){
            Swal.fire({
                type: 'success',
                timer: 1500,
                showConfirmButton: false,
            })
            .then(a=>window.location.href='projects');
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