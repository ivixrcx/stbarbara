


/* global declarations */
let warehouse = $('#list_warehouses');

function load_warehouse(){
  $.ajax({
    url: 'warehouse/list',
    type: 'post',
    success: function(res){

      // populate table
      $(warehouse).html('');
      if(res.has_data === true){
        $.each(res.data, function(key, data){
          html = '<tr data-id="' + data.warehouse_id + '">';
          html += '<td>' + data.name + '</td>';
          html += '<td>' + data.location + '</td>';
          html += '<td>' + data.contact_no + '</td>';
          html += '<td>';
          html += '<div class="d-flex justify-content-end">';
          html += '<a href="view/warehouse/' + data.warehouse_id + '" class="btn_view"><button class="btn btn-primary btn-sm">view</button></a>';
          html += '</div>';
          html += '</td>';
          html += '</tr>';
          $(warehouse).append(html);
        });
      }

      // touch gestures
      $('#list_warehouses tr').touch({
        useTouch: true,
        useMouse: false,
      })
      .on('ggtap', function(){
        html = `
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>`;

        Swal.fire({
          title:'Details',
          allowOutsideClick: false,
          html: html,

        });
      })
      .on('swipeLeft', function(){
        let row = $(this)
        Swal.fire({
          title:'Delete item?',
          allowOutsideClick: false,
          showConfirmButton: true,
          showCancelButton: true,
        })
        .then(function(result){
          if(result.value){
            let warehouse_id = $(row).data('id');
            $.ajax({
               type: 'post',
               url: 'warehouse/delete',
               data: {warehouse_id: warehouse_id},
               error: function(err){
                 console.log('error');
                 console.log(err);
               },
               success: function(res){
                 console.log('success');
                 if(res.data == true){
                   Swal.fire({
                     type: 'success',
                     title: 'Deleted',
                     text: 'Deletion Success', 
                     timer: 1500,
                   })
                   .then(function(){
                     load_warehouse();
                   });
                 }
               },
            });
          }
          else{
            Swal.close();
          }
        })
      });

    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
    },
  })
}

load_warehouse();