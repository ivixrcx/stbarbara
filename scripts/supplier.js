// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_suppliers').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'supplier/list_ss',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#list_houses_wrapper').html(access.error_html);
      }
      else{
        new deletion({
            button: 'button.btndelete',
            action: 'supplier/delete',
            redirect: 'suppliers'
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
    {data: 'description'},
    {data: 'address'},
    {data: 'contact_no'},
  ],
  columnDefs: [
    { 
      targets: 4,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        buttons += `<a href="view/supplier/${row['supplier_id']}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>`;
        buttons += `<a href="update/supplier/${row['supplier_id']}" class="btn btn-warning btn-sm mr-2"><i class="fa fa-pencil text-dark"></i></a>`;
        buttons += `<button class="btn btn-danger btn-sm mr-2 btndelete" data-supplier_id="${row['supplier_id']}"><i class="fa fa-remove text-dark"></i></button>`;
        buttons += `</div>`;
        return buttons;
      }
    },
  ]
});
