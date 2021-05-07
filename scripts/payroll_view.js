// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

const payroll_id = $("#payroll_id").val()

$('#t_additional').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'payroll/get_payroll_additionals/' + payroll_id,
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          // $('#list_of_staffs_wrapper').html(access.error_html);
      }
      else{
        new deletion({
          button: 'button.btndelete',
          action: 'payroll/delete_payroll_additional_process/' + payroll_id,
          redirect: 'view/payroll-details/' + payroll_id
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
    {data: 'name'},
    {data: 'amount'},
    {data: 'note'},
  ],
  columnDefs: [
    { 
      targets: 4,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-additional_id="${row['additional_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});


$('#t_deduction').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'payroll/get_payroll_deductions/' + payroll_id,
      type: 'post',
      complete: function(res){
        let access = res.responseJSON.data;
        if(access.code == 101){ // no permission
            // $('#list_of_staffs_wrapper').html(access.error_html);
        }
        else{
          new deletion({
            button: 'button.btndelete',
            action: 'payroll/delete_payroll_deduction_process/' + payroll_id,
            redirect: 'view/payroll-details/' + payroll_id
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
      {data: 'name'},
      {data: 'amount'},
      {data: 'note'},
    ],
    columnDefs: [
      { 
        targets: 4,
        render: function(data, type, row){
          let buttons = `<div class="d-flex justify-content-end">`;
          buttons += `<button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-deduction_id="${row['deduction_id']}"><i class="fa fa-remove text-dark"></i></button>`;
          buttons += `</div>`;
          return buttons;
        }
      },
    ]
  });
  
  
  