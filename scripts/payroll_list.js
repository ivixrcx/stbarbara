// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

let staff_id = $('#staff_id').val();

$('#list_of_payroll').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/list',
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
          action: 'payroll/delete/',
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
    {data: 'payroll_id'},
    {data: 'pay_date'},
    {data: 'basepay'},
    {data: 'net_pay'},
    {data: 'no_of_days'},
    {data: 'daily_compensation'},
    {data: 'total_additionals'},
    {data: 'total_deductions'},
  ],
  columnDefs: [
    { 
      targets: 7,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/payroll-details/${row['payroll_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-payroll_id="${row['payroll_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




