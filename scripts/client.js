// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_clients').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'client/list',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_clients_wrapper').html(access.error_html);
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
                url: 'client/delete',
                type: 'post',
                data: { client_id: id },
                success: function(res){
                  // successfully deleted
                  if(res.responseJSON.data){
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                  }
                },
                error: function(error){
                  
                  res = JSON.parse(error.responseText)
                  console.log(res)
                  Swal.fire({
                    title: 'Error: ' + res.data.code + ' ' + res.error,
                    html: res.data.error_html,
                    type: 'error',
                  })
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
    {data: 'client_id'},
    {data: 'first_name'},
    {data: 'last_name'},
    
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/client/${row['client_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btn-delete" data-id="${row['client_id']}"><i class="fa fa-remove text-dark"></i></button></div>`;
        return buttons;
      }
    },
  ]
});




