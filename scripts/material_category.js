


/* global declarations */
$('table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'materialcategory/list',
    type: 'post',
    complete: function(res){
      new deletion({
        button: 'button.btndelete',
        action: 'materialcategory/delete',
        redirect: 'materials-category'
      })
      .fire();
    },
    error: function(error){
      console.log('error');
      console.log(error.responseText);
    },
  },
  columns: [
    {data: 'material_category_id'},
    {data: 'particular'},
    {data: 'priority_level'},
    {data: null}
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
          return `
          <div class="d-flex justify-content-end">
              <a href="update/materials-category/${row['material_category_id']}" class="pull-right btn btn-warning btn-sm ml-1 system-module" data-module="materialcategory/update_view"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-material_category_id="${row['material_category_id']}"><i class="fa fa-remove text-dark"></i></button>
          </div>`;
      }
    },
  ]
});