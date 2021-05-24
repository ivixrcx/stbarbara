// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_projects').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'project/list',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_projects_wrapper').html(access.error_html);
      }
      else{
        new deletion({
            button: 'button.btndelete',
            action: 'project/delete',
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
    {data: 'project_id'},
    {data: 'name'},
    {data: 'total_area'},
    {data: 'total_units'},
    {data: 'location'},
  ],
  columnDefs: [
    { 
      targets: 5,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/project/${row['project_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<a href="update/project/${row['project_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-project_id="${row['project_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




