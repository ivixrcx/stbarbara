/* global declarations */

// disables error for user permission
$.fn.dataTable.ext.errMode = 'none';

$('#list_of_approved_purchase_orders').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'purchaseorder/approved_purchase_orders',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#approved-purchase-order').html(access.error_html);
      }
    },
    error: function(error){
      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      // alert(error.responseText);
    },
  },
  createdRow: function(row, data, dataIndex){
    $(row).css('cursor', 'pointer');
    let tds = $(row).contents().find('td').prevObject;
    for (var i = 0; i < tds.length-1; i++) {
      $(tds[i]).attr('title', 'Click to view')
      $(tds[i]).click(function(){
        window.location.href='purchaseorder/purchase_order_item_view/' + data.purchase_order_id;
      });
    }
  },
  columns: [
    {data: 'purchase_order_no'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    {data: 'user_note'},
    {
      data: null,
      render: function(data, type, row){
        return `
        <div class="d-flex justify-content-end">
        <a href="approved/purchase-order/${row['purchase_order_id']}" class="system-module" data-module="purchaseorder/approved_purchase_order_view"><button class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye text-dark"></i></button></a>
        <a href="print/purchase-order/${row['purchase_order_id']}" class="system-module" data-module="purchaseorder/print"><button class="btn btn-secondary btn-sm mr-2"><i class="fa fa-print text-dark"></i></button></a>`;
      }
    }
  ],
});

$('#list_of_approval_purchase_orders').DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: {
    url: 'purchaseorder/approval_purchase_orders',
    type: 'post',
    complete: function(res){
      let access = res.responseJSON.data;
      if(access.code == 101){ // no permission
          $('#approval-purchase-order').html(access.error_html);
      }
    }, 
    error: function(error){
      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      // alert(error.responseText);
    },
  },
  createdRow: function(row, data, dataIndex){
    $(row).css('cursor', 'pointer');
    let tds = $(row).contents().find('td').prevObject;
    for (var i = 0; i < tds.length-1; i++) {
      $(tds[i]).attr('title', 'Click to view')
      $(tds[i]).click(function(){
        window.location.href='purchase-order-items/' + data.purchase_order_id;
      });
    }
  },
  columns: [
    {data: 'purchase_order_no'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    {data: 'user_note'},
    {
      data: null,
      render: function(data, type, row){
        return `
        <div class="d-flex justify-content-end">
        <a href="approval/purchase-order/${row['purchase_order_id']}" class="system-module mr-2 btn btn-info btn-sm text-dark" data-module="purchaseorder/approve_purchase_order">Review</a>
        <a href="purchase-order-items/${row['purchase_order_id']}" class="system-module btn btn-primary btn-sm mr-2" data-module="purchaseorder/purchase_order_item_view"><i class="fa fa-eye text-dark"></i></a>
        </div>`;
      }
    }
  ],
  initComplete: function( settings, json ){
      // initialize checking in-text modules
      ua = new useraccess;
      ua.check($('a.system-module'));
  }
});