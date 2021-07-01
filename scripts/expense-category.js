


/* global declarations */

$('#list').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'expensecategory/list',
    type: 'post',
    complete: function(res){
      new deletion({
        button: 'button.btndelete',
        action: 'expensecategory/delete',
        redirect: 'expense-categories'
      })
      .fire();
    },
    error: function(error){
      console.log('error');
      console.log(error.responseText);
    },
  },
  columns: [
    {data: 'expense_category_id'},
    {data: 'category_name'},
  ],
  columnDefs: [
    { 
      targets: 2,
      render: function(data, type, row){
        return `
        <div class="d-flex justify-content-end">
            <a href="update/expense-category/${row['expense_category_id']}" class="pull-right btn btn-warning btn-sm ml-1 system-module" data-module="expensecategory/update_view"><i class="fa fa-pencil text-dark"></i></a>
            <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-expense_category_id="${row['expense_category_id']}"><i class="fa fa-remove text-dark"></i></button>
        </div>`;
      }
    },
  ]
});