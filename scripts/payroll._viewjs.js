// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_staffs').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/list_staff',
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
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
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
        buttons += `<a href="view/payroll/${row['staff_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




