$('#list_of_active_users').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'account/list_of_active_users',
    type: 'post',
    complete: function(res){
      // console.log(res.responseJSON.recordsTotal)
      $('#active_users').text(res.responseJSON.recordsTotal);

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
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
    },
  },
  columns: [
    {data: 'user_id'},
    {data: 'first_name'},
  ],
  columnDefs: [
    { 
      targets: 2,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<button class="btn btn-primary mr-2" data-id="${row['user_id']}" data-toggle="modal" data-target="#create_user_modal" ><i class="icon-paper-and-pencil"></i></button>`;
        buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['user_id']}"><i class="icon-close"></i></button></div>`;
        return buttons;
      }
    },
  ]
});




