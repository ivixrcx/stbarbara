$(function(){

  /* declarations */
  let items = $('#list_of_purchase_order_items');

  function load_purchase_order_items(){
    // reset list
    $(items).html('');

    // start ajax request
    $.ajax({
       type: 'post',
       url: 'purchaseorder/purchase_order_items',
       data: { 
         purchase_order_id: $(items).data('id')
       },
       error: (err) => {
         console.log('error');
         console.log(error);
       },
       success: (res) => {
         if(res.has_data == true){
            let total = 0;
            $.each(res.data, function(key, data){
              total += parseFloat(data.total);
              let html = '<tr>';
              html += '<td colspan="3">' + data.description + '</td>';
              html += '<td>' + data.quantity + '</td>';
              html += '<td>' + data.unit_price + '</td>';
              html += '<td>' + data.total + '</td>';
              html += '<td><button class="btn btn-danger btn-sm btn_remove pull-right" data-id="' + data.purchase_order_item_id + '" data-item="' + data.description + '"><i class="fa fa-remove text-dark"></i></button></td>';
              html += '</tr>';
              $(items).append( html );
            });

            $(items).append( '<tr><td colspan="7" align="middle">~~~~~~~~~~~~~ Nothing follows ~~~~~~~~~~~~~</td></tr>');

            let total_html = '<tr style="border-top: 10px double #28a745 !important;">';
            total_html += '<td colspan="6" style="font-size: 1.5em;" align="right">Grand Total:</td>';
            total_html += '<td style="font-size: 2em;" align="center"><strong>' + total + '</strong></td>';
            total_html += '</tr>';
            $(items).append( total_html );

            btn_remove_callback();
         }
         else{
           $(items).append('<tr><td colspan="7" align=middle>No Data</td></tr>')
           $('#btnAdd').click();
         }
       },
    });
  }
  

  function btn_remove_callback(){
    $('.btn_remove').click(function(){

      // declare btn_remove for callback
      let btn_remove = $(this);

      Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-danger',
          cancelButton: 'ml-2 btn btn-secondary',
        },
        buttonsStyling: false,
      })
      .fire({
        type: 'warning',
        title: 'Removing item "' + $(btn_remove).data('item') + '"',
        text: 'Are you sure to remove this item?',
        showConfirmButton: true,
        showCancelButton: true,
        focusConfirm: true,
      })
      .then(function(result){
        if(result.value){
          $.ajax({
            type: 'post',
            url: 'purchaseorder/delete_purchase_order_item',
            data: {
              purchase_order_item_id: $(btn_remove).data('id'),
            },
            error: (err)=>{
              console.log('error');
              console.log(err);
            },
            success: (res)=>{
              if(res.has_data == true){
                Swal.close();
                load_purchase_order_items();
              }
            },
          });
        }
      });    
    });
  }


  load_purchase_order_items();
});