/**
 * 
 * @param {*} e 
 */
// new deletion({
//     button: 'button.btndelete',
//     action: 'position/delete',
//     redirect: 'positions'
// })
// .fire();
const deletion = class{

    constructor(e){
        // init
        this.button = e.button
        this.action = e.action;
        this.redirect = e.redirect; 
        this.params = {}; 
        
        var params = {};
        $.each( $(this.button).data(), function(name, id){
            params[name] = id;
        });

        this.params = $.param(params);
    }

    // additional parameters
    params(callback){
        // var data = $(this.button).data();
    }

    // call trigger
    fire(){
        // if clicked
        $(this.button).click((e)=>{
            e.preventDefault();

            Swal.fire({
                type: 'warning', 
                title: 'Deletion',
                text: 'You can\'t revert this action.',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                confirmButtonColor: '#bb414d',
                showLoaderOnConfirm: true,
                preConfirm: (note) => {
                    return $.post(this.action, this.params)
                    .then(res=>res)
                    .catch(err=>{                
                        Swal.showValidationMessage(err.responseJSON.error)
                    });
                },
            })
            .then(res=>{
                if(res.value.data){
                    Swal.fire({
                        type: 'success', 
                        title: 'Deleted!',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    .then(res=>{
                        window.location.href=this.redirect;
                    });
                }
            });
        });
    }


}