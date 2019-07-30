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
    // {data: 'purchase_order_id'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    // {data: 'prepared_by'},
    // {data: 'prepared_date'},
    {data: 'user_note'},
    {
      data: null,
      render: function(data, type, row){
        return '<span style="color:' + row['status_color'] + '">' + row['status_name'] + '</span>';
      }
    },
    {
      data: null,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        // buttons += `<a href="purchaseorder/purchase_order_item_view/${row['purchase_order_id']}" class="btn_view"><button class="btn btn-primary mr-2">view</button></a>`;
        buttons += `<a href="purchaseorder/print/${row['purchase_order_id']}"><button class="btn btn-secondary mr-2">print</button></a>`;
        buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['purchase_order_id']}"><i class="icon-close"></i></button></a>`;
        // buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['purchase_order_id']}"><i class="icon-close"></i></button></div>`;
        return buttons;
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
        // window.location.href='purchaseorder/purchase_order_item_view/' + data.purchase_order_id;
      });
    }
  },
  columns: [
    // {data: 'purchase_order_id'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    // {data: 'prepared_by'},
    // {data: 'prepared_date'},
    {data: 'user_note'},
    {
      data: null,
      render: function(data, type, row){
        return '<span style="color:' + row['status_color'] + '">' + row['status_name'] + '</span>';
      }
    },
    {
      data: null,
      render: function(data, type, row){
        let buttons = `<div class="d-flex justify-content-end">`;
        // buttons += `<a href="purchaseorder/purchase_order_item_view/${row['purchase_order_id']}" class="btn_view"><button class="btn btn-primary mr-2">view</button></a>`;
        buttons += `<a href="purchaseorder/print/${row['purchase_order_id']}"><button class="btn btn-secondary mr-2">print</button></a>`;
        buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['purchase_order_id']}"><i class="icon-close"></i></button></a>`;
        // buttons += `<button class="btn btn-danger mr-2 btn-delete" data-id="${row['purchase_order_id']}"><i class="icon-close"></i></button></div>`;
        return buttons;
      }
    }
  ],
});