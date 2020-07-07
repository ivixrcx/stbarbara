


/* global declarations */
let list = $('#list');

$.ajax({
  url: 'expense/list',
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
          html = `
          <tr>
          <td>${data.expense_id}</td>
          <td>${data.cat_desc}</td>
          <td>${data.item_desc}</td>
          <td>${data.description}</td>
          <td>${data.amount}</td>
          <td>
            <div class="d-flex justify-content-end">
              <a href="update/expense/${data.expense_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
              <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-expense_id="${data.expense_id}"><i class="fa fa-remove text-dark"></i></button>
            </div>
          </td>
          </tr>`;
          $(list).append(html);
        });
      }
    }

    new deletion({
      button: 'button.btndelete',
      action: 'expense/delete',
      redirect: 'expenses'
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

$.post('expense/list')
.then(res=>{
  let access = res.data;
  if(access.code == 101){ // no permission
      $('table').html(access.error_html);
  }
  else{
    $(list).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = `
        <tr>
        <td>${data.expense_id}</td>
        <td>${data.cat_desc}</td>
        <td>${data.item_desc}</td>
        <td>${data.description}</td>
        <td>${data.amount}</td>
        <td>
          <div class="d-flex justify-content-end">
            <a href="update/expense/${data.expense_id}" class="pull-right btn btn-warning btn-sm ml-1"><i class="fa fa-pencil text-dark"></i></a>
            <button class="pull-right btn btn-danger btn-sm ml-1 btndelete" data-expense_id="${data.expense_id}"><i class="fa fa-remove text-dark"></i></button>
          </div>
        </td>
        </tr>`;
        $(list).append(html);
      });
    }
    else{
      html = `
      <tr>
        <td colspan=6>No Data</td>
      </tr>`;
      $(list).append(html);
    }
  }

  new deletion({
    button: 'button.btndelete',
    action: 'expense/delete',
    redirect: 'expenses'
  })
  .fire();

})
.catch(err=>{
  Swal.fire({
    type: 'error',
    title: 'Error',
    title: err
  });
});