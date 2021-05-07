// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_payroll').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/list',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_staffs_wrapper').html(access.error_html);
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
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});




