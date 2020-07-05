
/**
 * 
 */
$('table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'material/list',
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
          return `
          <div class="d-flex justify-content-end">
              <!-- <a href="view/material/${row['material_id']}" class="btn btn-primary btn-sm system-module" data-module="material/view"><i class="fa fa-eye text-dark"></i></a> -->
              <a href="update/material/${row['material_id']}" class="pull-right btn btn-warning btn-sm ml-1 system-module" data-module="material/update_view"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-material_id="${row['material_id']}"><i class="fa fa-remove text-dark"></i></button>
          </div>`;
      }
    },
  ]
});


