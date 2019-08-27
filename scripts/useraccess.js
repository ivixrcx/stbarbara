

/* global declarations */
var __modules = $('.system-module a');
var __request = $.post('account/get_session_permissions');

// sidebar
__request.done(function(result){
    var module_links = result.data;
    $.each( __modules, function(key, module_html){
        module_link = $(module_html).data('module');

        if($.inArray(module_link, module_links) == -1){
            $(module_html).parent().remove();
        }
        else{
            $(module_html).parent().removeAttr('style');
        }
    });
});


class useraccess {}
// returns promise
useraccess.prototype.request = function(){
    return __request;
}
/* callable for re-initialization */
// in-text
useraccess.prototype.check = function(_modules){
    __request.done(function(result){
        var module_links = result.data;
        $.each( _modules, function(key, module_html){
            module_link = $(module_html).data('module');
            $(module_html).click(function(e){
                e.preventDefault();
                if($.inArray(module_link, module_links) == -1){
                    Swal.fire({
                        type: 'error',
                        title: 'No Permission.',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 1500
                    });
                }
                else{
                    window.location.href=e.target.href;
                }
            });
        });
    });
}