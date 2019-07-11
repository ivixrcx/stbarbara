


/* global declarations */
let house = $('#list_houses');

$.ajax({
  url: 'house/list',
  type: 'post',
  success: function(res){
    console.log(res)
    $(house).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr>';
        html += '<td>' + data.house_id + '</td>';
        html += '<td>' + data.name + '</td>';
        html += '<td>' + data.lot_area + '</td>';
        html += '<td>' + data.floor_area + '</td>';
        html += '<td>' + data.suggested_price + '</td>';
        html += '<td></td>';
        html += '</tr>';
        $(house).append(html);
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