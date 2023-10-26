// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_staffs').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'staff/lists',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_staffs_wrapper').html(access.error_html);
      }
      else{
        // delete
        new deletion({
          button: 'button.btndelete',
          action: 'staff/delete',
          redirect: 'projects'
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
    {data: 'staff_id'},
    {data: 'first_name'},
    {data: 'last_name'},
    {data: 'job_description'},
    {data: 'status_name'},
  ],
  columnDefs: [
    { 
      targets: 5,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/staff/${row['staff_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<a href="update/staff/${row['staff_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-staff_id="${row['staff_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




