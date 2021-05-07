

/* global declarations */


$('#form_submit').validate({
  rules: {
    user_module_category_id: {
      required: true,
      digits: true,
    },
    user_module_name: {
      required: true,
      maxlength: 50,
    },
    user_module_link: {
      required: true,
      maxlength: 500,
    },
    user_module_description: {
      maxlength: 200,
    },
  },

  messages: {
    user_module_name: {
      required: "This field is required",
      maxlength: "Max of 50 characters"
    },
    user_module_link: {
      required: "This field is required",
      maxlength: "Max of 500 characters"
    },
    user_module_description: {
      maxlength: "Max of 200 characters"
    },
  },

  submitHandler: function (form) {

    let user_module_id = $("#user_module_id").val();
    let user_module_category_id = $("#user_module_category_id").val();
    let user_module_name = $("#user_module_name").val();
    let user_module_link = $("#user_module_link").val();
    let user_module_description = $("#user_module_description").val();

    $.ajax({
      url: "usermodule/update",
      type: 'post',
      data: { 
        user_module_id: user_module_id,
        user_module_name: user_module_name,
        user_module_link: user_module_link,
        user_module_description: user_module_description,
      },
      success: function (res) {
        if (res.has_data === true) {
          Swal.fire({
            type: 'success',
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            window.location.href = 'module-category/' + user_module_category_id;
          });
        }
        else{
            Swal.fire({
                type: 'error',
                title: 'no changes',
                showConfirmButton: false,
                timer: 1000,
            })
        }
      },
      error: function (err) {
        console.log('error');
        console.log(err);
      },
    });
  }

});