
/**
 * 
 */
$('table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'material/list_ss',
    type: 'post',
    complete: function(res){
      new deletion({
        button: 'button.btndelete',
        action: 'material/delete',
        redirect: 'materials'
      })
      .fire();
    },
    error: function(error){
      console.log('error');
      console.log(error.responseText);
    },
  },
  columns: [
    {data: 'material_particular'},
    {data: 'material_category_particular'},
    {data: 'unit'},
    {data: 'no_of_stocks'},
    {data: 'last_stock_date'},
    {data: 'stock_level'},
    {data: null}
  ],
  columnDefs: [
    { 
      targets: 6,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        // buttons += `<a href="view/material/${row['material_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<a href="update/material/${row['material_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-material_id="${row['material_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});


