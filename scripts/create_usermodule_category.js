

/* global declarations */

$('#form_submit').validate({
  rules: {
    user_module_category_name: {
      required: true,
      maxlength: 20
    }
  },

  messages: {
    user_module_category_name: {
      required: "This field is required",
      maxlength: "Max of 20 characters"
    }
  },

  submitHandler: function (form) {
    $.ajax({
      url: "usermodulecategory/create",
      type: 'post',
      data: { user_module_category_name: $("#user_module_category_name").val() },
      success: function (res) {
        if (res.has_data === true) {
          Swal.fire({
            type: 'success',
            title: 'Successfully created.',
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            window.location.href = 'usermodulecategory/list_view';
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