


/* global declarations */
let project = $('#list_projects');

$.ajax({
  url: 'project/list',
  type: 'post',
  success: function(res){
    let access = res.data;
    if(access.code == 101){ // no permission
        $('table').html(access.error_html);
    }
    else{
      $(project).html('');
      if(res.has_data === true){
        $.each(res.data, function(key, data){
          html = '<tr>';
          html += '<td>' + data.project_id + '</td>';
          html += '<td>' + data.name + '</td>';
          html += '<td colspan="2">' + data.total_area + '</td>';
          html += '<td colspan="3">' + data.total_units + '</td>';
          html += '<td>' + data.location + '</td>';
          html += '<td></td>';
          html += '</tr>';
          $(project).append(html);
        });
      }
    }
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})