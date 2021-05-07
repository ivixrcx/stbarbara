// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$("#staff").keyup(function(){
    // set data-exist to false by default
    $(this).data('exist', false);
  
    $.post('staff/search',{
      particular: $(this).val(),
    })
    .then(res=>{
      if(res.has_data){
        let list = [];
        $.each(res.data, function( key, data ){
          list.push({
              id: data.staff_id,
              data: data.last_name + ', ' + data.first_name + ' - ' + data.job_description,
          });
        });
        
        $('#staff_id').on('input', function(){
        //   $('#unit').attr('readonly', false)
        //   $('#unit').val('');
        });
  
        let ac = new autocomplete($("#staff"), list)
        ac.itemSelected((id,val,input)=>{
          // when item is selected it means its exists
          $(this).data('exist', true);
  
          let name = val.split('/')[0];
        //   let unit = val.split('/')[1].split(' ')[0];
          
        //   $('#unit').attr('readonly', true);
        //   $('#unit').val(unit);
          $('#staff').val(name);
          $('#staff_id').val(id);
        });
      }
    })
    .catch(err=>{
      Swal.showValidationMessage(err.responseJSON.data.error);
    });
});

$('#frm_add_staff_in_project').validate({
    rules: {
        staff: {
        required: true,
      },
    },
  
    messages: {
        staff: {
          required: "This field is required",
      }
    },
  
    submitHandler: function(form){
      $.ajax({
        url: 'project/create_staff_in_project_process',
        type: 'post',
        data: {
            project_id: $('#project_id').val(),
            staff_id: $('#staff_id').val(),
        },
        success: function(res){
          if(res.has_data === true){
            Swal.fire({
              type: 'success',
              title: 'Successfully created.',
              showConfirmButton: false,
              timer: 1500,
            }).then(function(){
              window.location.href='view/project/' + $('#project_id').val();
            });
          }
        },
        error: function(err){
          console.log('error');
          console.log(err);
        },
      });
    }
  
  });