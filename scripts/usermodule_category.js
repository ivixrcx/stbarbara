


/* global declarations */
let table = $('#list_usermodulecategories');

$.ajax({
  url: 'Usermodulecategory/list',
  type: 'post',
  success: function(res){
    $(table).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr>';
        if( data.module_count == 0 ){
          html += '<td>' + data.user_module_category_name + '</td>';
        }
        else if( data.module_count == 1 ){
          html += '<td>' + data.user_module_category_name + ' <code>' + data.module_count + ' module</code></td>';
        }
        else{
          html += '<td>' + data.user_module_category_name + ' <code>' + data.module_count + ' modules</code></td>';

        }
        html += '<td><a href="usermodule/list_view/' + data.user_module_category_id + '" class="pull-right btn btn-primary">view</a></td>';
        html += '</tr>';
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