// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#t_additional').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/get_payroll_additionals',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          // $('#list_of_staffs_wrapper').html(access.error_html);
      }
      else{
        $('.btn_delete_additional').click(function(){
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
    {data: 'date'},
    {data: 'name'},
    {data: 'amount'},
    {data: 'note'},
  ],
  columnDefs: [
    { 
      targets: 5,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-house_id="${data.additional_id}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




