// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'expense/list',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_houses_wrapper').html(access.error_html);
      }
      else{
        new deletion({
            button: 'button.btndelete',
            action: 'expense/delete',
            redirect: 'expenses'
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
    {data: 'or_no'},
    {data: 'expense_name'},
    {data: 'category_name'},
    {data: 'total'},
    {data: 'note'},
  ],
  columnDefs: [
    { 
      targets: 6,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/expense/${row['expense_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<a href="update/expense/${row['expense_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-expense_id="${row['expense_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});
