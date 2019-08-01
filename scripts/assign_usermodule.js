/* global declarations */

var modules = [];

/**
 * 
 */

$.ajax({
    type: 'post',
    url: 'usermodules',
});

/**
 * 
 */


$('.modules').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    var mod = $(this).find('code');
    var id  = $(this).data('id');

    if( Number.isInteger(id) === false || id === 0 ){
        return false;
    }

    if(mod.hasClass('selected')){

        mod.removeClass('selected');

        var _modules = [];
        $.each(modules, function(key, value){
            if(value != id){
                _modules.push(value)
            }
        });
        modules = _modules;
    }
    else{
        mod.addClass('selected');
        if(!modules.includes(id)){
            modules.push(id);
        }
    }
});

$('#btnsubmit').click(function(){
    user_id = $(this).data('id');

    if(user_id == ''){
        return false;
    }
    
    $.ajax({
        type: 'post',
        url: 'usermodule/assign_user_modules',
        data: {
            user_id: user_id,
            user_modules: modules.toString()
        },
        error: function (err) {
            console.log('error');
            console.log(err);
        },
        success: function (res) {
            if (res.has_data === true) {
                Swal.fire({
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                })
                .then(function () {
                    window.location.href = 'user/' + user_id;
              });
            }
        },
    })
});