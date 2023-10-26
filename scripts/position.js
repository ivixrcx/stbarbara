/* global declarations */
let list = $('#list');

// table lists
$.ajax({
  url: 'position/lists',
  type: 'post',
  success: function(res){

    // populate table
    $(list).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr data-id="' + data.user_type_id + '">';
        
        no_of_users = parseInt(data.no_of_users);

        if(no_of_users > 0){
          html += '<td>' + data.name + ' <code class="text-primary">' + no_of_users + '</code> ' + '</td>';
        }
        else{
          html += '<td>' + data.name + '</td>';
        }
        
        html += '<td>';
        html += '<div class="d-flex justify-content-end">';
        html += '<a href="view/position/' + data.user_type_id + '"><button class="btn btn-primary btn-sm"><i class="fa fa-eye text-dark"></i></button></a>';
        html += '<a href="update/position/' + data.user_type_id + '"><button class="btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></button></a>';
        html += '<button data-user_type_id="' + data.user_type_id + '"data-user_type_id="3"  data-id2="2"" class="btn btn-danger btn-sm ml-1 btndelete"><i class="fa fa-remove text-dark"></i></button>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';
        $(list).append(html);
      });
    }
  },
  complete: function(){
    
    // initialize
    new deletion({
        button: 'button.btndelete',
        action: 'position/delete',
        redirect: 'positions'
    })
    .fire();
  }
});