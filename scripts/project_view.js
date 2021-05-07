// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

const project_id = $("#project_id").val()

$('#staffs').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'project/get_staff_in_project/' + project_id,
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          // $('#list_of_staffs_wrapper').html(access.error_html);
      }
      else{
        new deletion({
          button: 'button.btndelete',
          action: 'project/remove_staff_in_project' ,
          redirect: 'view/project/' + project_id 
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
    {data: 'full_name'},
    {data: 'job_description'},
    // {data: 'amount'},
    // {data: 'note'},
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-staff_id="${row['staff_id']}" data-project_id="${row['project_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});
  