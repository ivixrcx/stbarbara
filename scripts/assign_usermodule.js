
/* global declarations */

var modules = [];
var user_modules = '';
var user_module_link = '';
var table = $('table');
var user_id = $('table').data('id');

/**
 * 
 */

// select modules assigned to current user
$.ajax({
    type: 'post',
    url: 'usermodule/get_assigned_user_modules',
    data: { user_id: user_id },
    error: function(err){
        console.log('error');
        console.log(err);
    },
    success: function(res){
        if(res.has_data){
            if(res.data.code == 101){
                $('.block').html(res.data.error_html);
            }

            var user_modules = res.data;
            
            $.each(user_modules, function(key, user_module){

                user_module_id = user_module.user_module_id;
                td_modules = $(table).contents().find('td.modules');
                
                $.each(td_modules, function(key, td_module){

                    td_user_module_id = $(td_module).data('id')
                    if(td_user_module_id == user_module_id){
                        
                        // declare __user_module_id
                        __user_module_id = "";

                        module_link = $(td_module).contents().find('code.module-link').prevObject;
                        $.each(module_link, function(key, link){

                            if(__user_module_id != td_user_module_id){
                                // update modules array
                                modules.push(td_user_module_id);
                            }
                            // prevent repeated user_module_id in modules array
                            __user_module_id = td_user_module_id;
                        
                            $(link).addClass('selected');
                        })
                       
                    }
                });

            });
        }
        else{
            // nothing
        }
    }
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