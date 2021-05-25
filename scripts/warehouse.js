// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_warehouses').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'warehouse/list_ss',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_of_warehouses_wrapper').html(access.error_html);
      }
      else{
        new deletion({
          button: 'button.btndelete',
          action: 'warehouse/delete',
          redirect: 'warehouses'
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
    {data: 'name'},
    {data: 'location'},
    {data: 'contact_no'},
    
  ],
  columnDefs: [
    { 
      targets: 3,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/warehouse/${row['warehouse_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        // buttons += `<a href="update/warehouse/${row['warehouse_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-warehouse_id="${row['warehouse_id']}"><i class="fa fa-remove text-dark"></i></button></div>`;
        return buttons;
      }
    },
  ]
});