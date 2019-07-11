$('#list_of_active_purchase_orders').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'purchaseorder/purchase_orders',
    type: 'post',
    complete: function(res){
      $('.btn-delete').click(function(){
        let id = $(this).data('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#367838',
          // cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {

            // delete user
            $.ajax({
              url: 'account/delete_user_process',
              type: 'post',
              data: { user_id: id },
              complete: function(res){
                // successfully deleted
                if(res.responseJSON.data){
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
                else{
                  console.log(res);
                  Swal.fire({
                    title: 'Error',
                    text: res.responseJSON.data,
                    type: 'error',
                  })
                }
              },
              error: function(error){
                // Swal.fire(error.responseText);
                console.log('error');
                console.log(error.responseText);
                alert(error.responseText);
              },
            });

            
          }
        })
      })
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
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
    {data: 'purchase_order_id'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    {data: 'prepared_by'},
    {data: 'prepared_date'},
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
    url: 'purchaseorder/purchase_orders/9',
    type: 'post',
    complete: function(res){
      $('.btn-delete').click(function(){
        let id = $(this).data('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#367838',
          // cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {

            // delete user
            $.ajax({
              url: 'account/delete_user_process',
              type: 'post',
              data: { user_id: id },
              complete: function(res){
                // successfully deleted
                if(res.responseJSON.data){
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
                else{
                  console.log(res);
                  Swal.fire({
                    title: 'Error',
                    text: res.responseJSON.data,
                    type: 'error',
                  })
                }
              },
              error: function(error){
                // Swal.fire(error.responseText);
                console.log('error');
                console.log(error.responseText);
                alert(error.responseText);
              },
            });

            
          }
        })
      })
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
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
    {data: 'purchase_order_id'},
    {data: 'requested_by'},
    {data: 'requested_date'},
    {data: 'prepared_by'},
    {data: 'prepared_date'},
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