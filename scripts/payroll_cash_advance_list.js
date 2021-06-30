// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

staff_id = $('#staff_id').val();

$('#list_of_ca').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/cash_advance_list',
    type: 'post',
    data: { staff_id: staff_id },
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_staffs_wrapper').html(access.error_html);
      }
      else {
        new deletion({
          button: 'button.btndelete',
          action: 'payroll/delete_cash_advance/',
          redirect: 'view/payroll/' + staff_id
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
    {data: 'date'},
    {data: 'amount'},
    {data: 'note'},
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-cash_advance_id="${row['cash_advance_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




