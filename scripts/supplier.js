


/* global declarations */
let list = $('#list_suppliers');

$.post('supplier/list')
.then(res=>{
  $(list).html('');
  if(res.has_data === true){
    $.each(res.data, function(key, data){
      html = `
      <tr>
        <td>${data.supplier_id}</td>
        <td>${data.name}</td>
        <td colspan="2">${data.description}</td>
        <td colspan="3">${data.address}</td>
        <td>${data.contact_no}</td>
        <td>
          <div class="d-flex justify-content-end">
            <a href="update/supplier/${data.supplier_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
            <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-supplier_id="${data.supplier_id}"><i class="fa fa-remove text-dark"></i></button>
          </div>
        </td>
      </tr>`;
      $(list).append(html);
    });
  }
  else{
    html = `
    <tr>
      <td colspan=9>No Data</td>
    </tr>`;
    $(list).append(html);
  }

  new deletion({
    button: 'button.btndelete',
    action: 'supplier/delete',
    redirect: 'suppliers'
  })
  .fire();
})
.catch(err=>{
  Swal.fire({
    type: 'error',
    title: 'Error',
    title: err
  });
});