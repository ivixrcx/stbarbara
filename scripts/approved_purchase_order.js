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
              html += '</tr>';
              $(items).append( html );
            });

            $(items).append( '<tr><td colspan=6" align="middle">~~~~~ Nothing follows ~~~~~</td></tr>');

            let total_html = '<tr style="border-top: 7px double #28a745 !important;">';
            total_html += '<td colspan="5" style="font-size: 1.5em;" align="right">Grand Total:</td>';
            total_html += '<td style="font-size: 2em;"><strong>' + total + '</strong></td>';
            total_html += '</tr>';
            $(items).append( total_html );

            btn_remove_callback();



         }
         else{
           $(items).append('<tr><td colspan="7" align=middle>No Data</td></tr>')
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


  // approve button
  $('button#btn_approve').click(function(){
    Swal.fire({
        type: 'info',
        title: 'Approve PO',
        text: 'I checked and verified items in list.',
        confirmButtonText: 'Approve!',
        cancelButtonText: 'Oh no, cancel!',
        confirmButtonColor: '#429244',
        showCancelButton: true,
        preConfirm: flag => {
            if(flag){
                return $.post('purchaseorder/approve_purchase_order',{ 
                    purchase_order_id: $(items).data('id') 
                })
                .then(res=>res)
                .catch(err=>{
                    Swal.showValidationMessage(err.responseJSON.error);
                });
            }
        }
    })
    .then(res=>{
        Swal.fire('im fine');
    });
  });

  // disapprove button
  $('button#btn_disapprove').click(function(){
    Swal.fire({
        type: 'warning', 
        title: 'Disapprove',
        text: 'You can\'t revert this action.',
        input: 'textarea',
        showCancelButton: true,
        confirmButtonText: 'Disapprove!',
        confirmButtonColor: '#bb414d',
        showLoaderOnConfirm: true,
        preConfirm: (note) => {
            return $.post('purchaseorder/disapprove_purchase_order',{
                purchase_order_id: $(items).data('id'),
                admin_note: note,
            })
            .then(res=>res)
            .catch(err=>{                
                Swal.showValidationMessage(err.responseJSON.error)
            });
        },
    })
    .then(res=>{
        if(res.value.data){
            Swal.fire({
                type: 'success', 
                title: 'Disapproved!',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1500
            })
            .then(res=>{
                window.location.href='purchase-orders'
            });
        }
    });
  });

});