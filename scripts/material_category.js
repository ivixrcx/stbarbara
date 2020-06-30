


/* global declarations */
let list = $('#list');

$.ajax({
  url: 'materialcategory/list',
  type: 'post',
  success: function(res){
    let access = res.data;
    if(access.code == 101){ // no permission
        $('table').html(access.error_html);
    }
    else{
      $(list).html('');
      if(res.has_data === true){
        $.each(res.data, function(key, data){
        console.log(data)
          html = `
          <tr>
          <td>${data.material_category_id}</td>
          <td>${data.particular}</td>
          <td>${data.priority_level}</td>
          <td>
            <div class="d-flex justify-content-end">
              <a href="update/materials-category/${data.material_category_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-material_category_id="${data.material_category_id}"><i class="fa fa-remove text-dark"></i></button>
            </div>
          </td>
          </tr>`;
          $(list).append(html);
        });
      }
    }

    new deletion({
      button: 'button.btndelete',
      action: 'materialcategory/delete',
      redirect: 'materials-category'
    })
    .fire();
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})