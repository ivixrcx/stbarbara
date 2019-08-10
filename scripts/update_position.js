/* global declarations */

$('form').validate({
    rules: {
        name: {
            required: true,
            maxlength: 20,
            minlength: 3,
        },
    },

    messages: {
        name: {
            required: "This field is required",
            maxlength: "Max of 50 characters",
        }
    }
});

$('form').submit(function(e){
    e.preventDefault();
    
    let user_type_id = $('#user_type_id').val();
    let name = $('#name').val();

    $.ajax({
        url: 'position/update',
        type: 'post',
        data: {
            user_type_id: user_type_id,
            name: name
        },
        success: function(res){
            if(res.has_data === true){
            Swal.fire({
                type: 'success',
                title: 'Successfully updated.',
                showConfirmButton: false,
                timer: 1500,
            }).then(function(){
                window.location.href='view/position/' + user_type_id;
            });
            }
            
        },
        error: function(err){
            console.log('error');
            console.log(err);
        },
    });
    
});

