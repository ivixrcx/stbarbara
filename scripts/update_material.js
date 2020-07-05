

/* global declarations */

$('form').validate({
    rules: {
        particular: {
            required: true,
            maxlength: 50,
        },
        unit: {
            required: true,
        },
        stock_level: {
            required: true,
            min: 1,
        },
    },
    submitHandler: function(form){
        // checking if material exists
        let particular = $('#particular').val();
        let unit = $('#unit').val();
        let stock_level = $('#stock_level').val();

        $.post('material/search_particular_unit', {
            particular: particular,
            unit: unit
        })
        .then(res=>{
        if(res.data.length){
            Swal.fire({
            type: 'error',
            html: `Material "<b>${particular}</b>" exists.`,
            });
        }
        else{
            $.post('material/update', $(form).serialize())
            .then(res=>{
                if(res.has_data){
                Swal.fire({
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                .then(()=>{
                    window.location.href='materials';
                });
                }
                else{
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    title: res.error_html
                });
                }
            })
            .catch(err=>{
            console.log('error', err);
            throw 'error: ' + err;
            });
        }
        })
        .catch(err=>{
        console.log('error', err);
        throw 'error: ' + err;
        });
    }
});