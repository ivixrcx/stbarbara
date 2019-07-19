


/* global declarations */
let table = $('#list_usermodules');
let user_module_category_id = $(table).data('id');

$.ajax({
  url: 'usermodule/list',
  data: { user_module_category_id: user_module_category_id },
  type: 'post',
  success: function(res){
    $(table).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr>';
        html += '<td>' + data.user_module_name + '</td>';
        // html += '<td><a href="usermodule/list_view/' + data.user_module_category_id + '" class="pull-right btn btn-primary">view</a></td>';
        html += '</tr>';
        $(table).append(html);
      });
    }
    else{
      html = '<tr>';
      html += '<td>No Data</td>';
      html += '</tr>';
      $(table).append(html);
    }
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})