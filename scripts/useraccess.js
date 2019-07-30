$(function(){
    $.ajax({
        type: 'post',
        url: 'account/get_session_permissions',
        success: function(res){
            let module_links = res.data;
            let system_module = $('.system-module');
            let system_modules = system_module.contents().find('a').prevObject;
            
            $.each( system_modules, function(key, module_html){
                module_link = $(module_html).data('module');
                
                if($.inArray(module_link, module_links) == -1){
                    $(module_html).parent('.system-module').remove();
                }
                else{
                    $(module_html).parent('.system-module').removeAttr('style');
                }
            });
        }
    })
});