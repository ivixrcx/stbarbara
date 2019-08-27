


/* global declarations */
let table = $('#list_usermodulecategories');

$.ajax({
  url: 'usermodulecategory/list',
  type: 'post',
  success: function(res){
    $(table).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr>';
        if( data.module_count == 0 ){
          html += `<td>${data.user_module_category_name}</td>`;
        }
        else if( data.module_count == 1 ){
          html += `<td>${data.user_module_category_name} <code>${data.module_count} module</code></td>`;
        }
        else{
          html += `<td>${data.user_module_category_name} <code>${data.module_count} modules</code></td>`;
        }
        html += `
          <td>
            <div class="d-flex justify-content-end">
            <a href="module-category/${data.user_module_category_id}" class="pull-right btn btn-primary btn-sm ml-1"><i class="fa fa-eye text-dark"></i></a>
            <a href="update/module-category/${data.user_module_category_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
            </div>
          </td>
        </tr>`;
        $(table).append(html);
      });
    }
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})