


/* global declarations */

$('table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'expenseitem/list_ssp',
    type: 'post',
    complete: function(res){
      console.log(res)
      new deletion({
        button: 'button.btndelete',
        action: 'expenseitem/delete',
        redirect: 'expense-items'
      })
      .fire();
    },
    error: function(error){
      console.log('error');
      console.log(error.responseText);
    },
  },
  columns: [
    {data: 'category'},
    {data: 'description'},
    {data: null}
  ],
  columnDefs: [
    { 
      targets: 2,
      render: function(data, type, row){
          return `
          <div class="d-flex justify-content-end">
              <a href="update/expense-item/${row['expense_item_id']}" class="pull-right btn btn-warning btn-sm ml-1 system-module" data-module="expenseitem/update_view"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-expense_item_id="${row['expense_item_id']}"><i class="fa fa-remove text-dark"></i></button>
          </div>`;
      }
    },
  ]
});