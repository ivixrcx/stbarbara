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
        new deletion({
          button: 'button.btndelete',
          action: 'client/delete',
          redirect: 'client'
        })
        .fire();
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
        // buttons += `<a href="update/client/${row['client_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-client_id="${row['client_id']}"><i class="fa fa-remove text-dark"></i></button></div>`;
        return buttons;
      }
    },
  ]
});




