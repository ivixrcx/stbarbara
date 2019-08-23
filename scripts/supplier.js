


/* global declarations */
let supplier = $('#list_suppliers');

$.ajax({
  url: 'supplier/list',
  type: 'post',
  success: function(res){
    console.log(res)
    $(supplier).html('');
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
        $(supplier).append(html);
      });
    }

    new deletion({
      button: 'button.btndelete',
      action: 'supplier/delete',
      redirect: 'suppliers'
    })
    .fire();
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
});