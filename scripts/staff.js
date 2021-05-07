// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_staffs').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'staff/list',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_staffs_wrapper').html(access.error_html);
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
                url: 'staff/delete_staff_process',
                type: 'post',
                data: { staff_id: id },
                completed: function(res){
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
                  if(parseInt(error.status) == 401){
                    Swal.fire({
                      title: 'System Message',
                      text: error.statusText,
                      type: 'error',
                    })
                  }
                  else{
                    console.log(error)
                  }
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
        if(row['status_id'] == 1){
          buttons += `<button  alt="tes1t" class="btn btn-danger btn-sm mr-2 btn-delete" data-id="${row['staff_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        }
        else if(row['status_id'] == 2){
          buttons += `<button alt="test" class="btn btn-secondary btn-sm mr-2 btn-activate" data-id="${row['staff_id']}"><i class="fa fa-check text-dark"></i></button>`;
        }
        else{
          // do nothing
        }
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




