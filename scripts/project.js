


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
          html = `
          <tr>
            <td>${data.project_id}</td>
            <td>${data.name}</td>
            <td colspan="2">${data.total_area}</td>
            <td colspan="3">${data.total_units}</td>
            <td>${data.location}</td>
            <td>
              <div class="d-flex justify-content-end">              
                <a href="view/project/${data.project_id}" class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></a>
                <a href="update/project/${data.project_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
                <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-project_id="${data.project_id}"><i class="fa fa-remove text-dark"></i></button>
              </div>
            </td>
          </tr>`;
          $(project).append(html);
        });
      }

      new deletion({
          button: 'button.btndelete',
          action: 'project/delete',
          redirect: 'projects'
      })
      .fire();
    }
  },
  error: function(error){

    // Swal.fire(error.responseText);
    console.log('error');
    console.log(error.responseText);
    alert(error.responseText);
  },
})