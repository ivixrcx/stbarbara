/* global declarations */
let list = $('#list');

// table lists
$.ajax({
  url: 'position/list',
  type: 'post',
  success: function(res){

    // populate table
    $(list).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr data-id="' + data.user_type_id + '">';
        
        no_of_users = parseInt(data.no_of_users);
        
        switch(true){
          case (no_of_users == 1): 
            html += '<td>' + data.name + ' (<code class="text-primary">' + no_of_users + ' user registered</code>) ' + '</td>';
            break;
          case (no_of_users > 1):
            html += '<td>' + data.name + ' (<code class="text-primary">' + no_of_users + ' users registered</code>) ' + '</td>';
            break;
          default: 
            html += '<td>' + data.name + '</td>';
        }
        
        html += '<td>';
        html += '<div class="d-flex justify-content-end">';
        html += '<a href="view/position/' + data.user_type_id + '"><button class="btn btn-primary btn-sm"><i class="fa fa-eye text-dark"></i></button></a>';
        html += '<a href="update/position/' + data.user_type_id + '"><button class="btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></button></a>';
        html += '<button data-id="' + data.user_type_id + '" class="btn btn-danger btn-sm ml-1 btndelete"><i class="fa fa-remove text-dark"></i></button>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';
        $(list).append(html);
      });
    }
  },
  complete: function(){
    
    // initialize
    deletion();
  }
});

// clicking delete button
var deletion = ()=>{

  $('.btndelete').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
      url: 'position/delete',
      type: 'post',
      data: { user_type_id: id },
      success: function(res){
        if(res.has_data === true){
          
          // if user has no access for deletion
          if(res.data.code == 101){
            Swal.fire({
              type: 'error',
              html: '<span class="text-white">' + res.data.error_html + '</span>',
              showConfirmButton: false,
              timer: 1500,
            })
          }
          else{
            Swal.fire({
                type: 'success',
                title: 'Deletion success.',
                showConfirmButton: false,
                timer: 1500,
            })
            .then(function(){
                window.location.href='positions';
            });
          }
        }            
      },
      error: function(err){
        console.log('error');
        console.log(err);
      },
    });
  });
}