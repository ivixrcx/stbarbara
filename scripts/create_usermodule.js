

/* global declarations */


$('#form_submit').validate({
  rules: {
    user_module_category_id: {
      required: true,
      digits: true,
    },
    user_module_name: {
      required: true,
      maxlength: 20,
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
      maxlength: "Max of 20 characters"
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

    let user_module_name = $("#user_module_name").val();
    let user_module_link = $("#user_module_link").val();
    let user_module_description = $("#user_module_description").val();
    let user_module_category_id = $("#user_module_category_id").val();

    $.ajax({
      url: "usermodule/create",
      type: 'post',
      data: { 
        user_module_category_id: user_module_category_id,
        user_module_name: user_module_name,
        user_module_link: user_module_link,
        user_module_description: user_module_description,
      },
      success: function (res) {
        if (res.has_data === true) {
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            window.location.href = 'module-category/' + user_module_category_id;
          });
        }
      },
      error: function (err) {
        console.log('error');
        console.log(err);
      },
    });
  }

});