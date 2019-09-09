$('form').submit(function(e){
    e.preventDefault();

    $.post('account/login_process', $(this).serialize())
    .then(res=>{
        if(res.has_data){
            window.location.href='home';
        }
        else{
            Swal.fire({
                type: 'error',
                title: 'Invalid Login.',
                timer: 1500,
                showConfirmButton: false,
            });
        }
    })
    .catch(err=>{
        Swal.fire({
            type: 'error',
            title: err.responseJSON,
            text: err.responseText,
            timer: 1500,
            showConfirmButton: false,
        });
    });
});