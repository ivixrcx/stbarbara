// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_active_users').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'account/list_of_active_users',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_active_users_wrapper').html(access.error_html);
      }
      else{
        $('.btn-delete').click(function(){
          let id = $(this).data('id');
  
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#367838',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
  
              // delete user
              $.ajax({
                url: 'account/delete_user_process',
                type: 'post',
                data: { user_id: id },
                complete: function(res){
                  // successfully deleted
                  if(res.responseJSON.data){
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                  }
                  else{
                    console.log(res);
                    Swal.fire({
                      title: 'Error',
                      text: res.responseJSON.data,
                      type: 'error',
                    })
                  }
                },
                error: function(error){
                  // Swal.fire(error.responseText);
                  console.log('error');
                  console.log(error.responseText);
                  alert(error.responseText);
                },
              });
  
              
            }
          })
        })
      }
    },
    error: function(error){
      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      // alert(error.responseText);
    },
  },
  columns: [
    {data: 'user_id'},
    {data: 'first_name'},
    {data: 'user_type'},
    
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="user/${row['user_id']}" class="btn btn-primary mr-2">view</a>`;
        buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['user_id']}"><i class="icon-close"></i></button></div>`;
        return buttons;
      }
    },
  ]
});




