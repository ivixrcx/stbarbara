/* global declarations */

var modules = [];

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
    
    let name = $('#name').val();

    if( name == "" || !modules.length ){

        Swal.fire({

        });

    }
    else{

        $.ajax({
            url: 'position/create',
            type: 'post',
            data: {
              name: $('#name').val(),
              default_user_modules: modules.toString(),
            },
            success: function(res){
              if(res.has_data === true){
                Swal.fire({
                  type: 'success',
                  title: 'Successfully created.',
                  showConfirmButton: false,
                  timer: 1500,
                }).then(function(){
                  window.location.href='positions';
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

