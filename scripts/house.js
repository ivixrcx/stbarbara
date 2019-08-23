


/* global declarations */
let house = $('#list_houses');

$.ajax({
  url: 'house/list',
  type: 'post',
  success: function(res){
    let access = res.data;
    if(access.code == 101){ // no permission
        $('table').html(access.error_html);
    }
    else{
      $(house).html('');
      if(res.has_data === true){
        $.each(res.data, function(key, data){
          html = `
          <tr>
          <td>${data.house_id}</td>
          <td>${data.name}</td>
          <td>${data.lot_area}</td>
          <td>${data.floor_area}</td>
          <td>${data.suggested_price}</td>
          <td>
            <div class="d-flex justify-content-end">
              <a href="update/house/${data.house_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-house_id="${data.house_id}"><i class="fa fa-remove text-dark"></i></button>
            </div>
          </td>
          </tr>`;
          $(house).append(html);
        });
      }
    }

    new deletion({
      button: 'button.btndelete',
      action: 'house/delete',
      redirect: 'houses'
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