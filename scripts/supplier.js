


/* global declarations */
let supplier = $('#list_suppliers');

$.ajax({
  url: 'supplier/list',
  type: 'post',
  success: function(res){
    console.log(res)
    $(supplier).html('');
    if(res.has_data === true){
      $.each(res.data, function(key, data){
        html = '<tr>';
        html += '<td>' + data.supplier_id + '</td>';
        html += '<td>' + data.name + '</td>';
        html += '<td colspan="2">' + data.description + '</td>';
        html += '<td colspan="3">' + data.address + '</td>';
        html += '<td>' + data.contact_no + '</td>';
        html += '<td></td>';
        html += '</tr>';
        $(supplier).append(html);
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