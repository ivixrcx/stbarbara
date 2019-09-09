


/* global declarations */
let stock_all    = $('#list_stock_all');
let stock_in     = $('#list_stock_in');
let stock_out    = $('#list_stock_out');
let warehouse_id = $('#warehouse_id').val();

/* all stocks */
$(stock_all).DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: {
    url: 'stock/all',
    type: 'post',
    data: { warehouse_id: warehouse_id },
    complete: function(res){
      // do nothing
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
    },
  },
  createdRow: function(row, data, dataIndex){
    if(data.stock_in_id != null){
      $(row).contents().find('td').prevObject.addClass('bg-success').addClass('text-dark')
    }
    else if(data.stock_out_id != null){
      $(row).contents().find('td').prevObject.addClass('bg-danger');
    }
    // $(row).addClass('text-')
    $(row).touch({
      useTouch: true,
      useMouse: false,
      noClick: false,
      tapAndHoldDelay: 5000,
      tapDelay: 5000,
    })
    .on('swipeLeft', function(e){
      Swal.fire({
        title:'shit',
        text:'Tapped!',
        timer: 1500
      });
    })
  },
  columns: [
    // {
    //   data: null,
    //   render: function(data, type, row){
    //     if(row['stock_in_id'] != null){
    //       return '<span class="text-success">stock in</span>';
    //     }
    //     else if(row['stock_out_id'] != null){
    //       return '<span class="text-danger">stock out</span>';
    //     }
    //     else{
    //       return ':error:';
    //     }
    //   }

    // },
    {
      data: null,
      render: function(data, type, row){
        if(row['stock_in_id'] != null){
          return row['stock_in_material'];
        }
        else if(row['stock_out_id'] != null){
          return row['stock_out_material'];
        }
        else{
          return 'no material';
        }
      }
    },
    {data: 'quantity'},
    {data: 'date'},
    {data: 'remarks'},
  ],
});

$(stock_in).DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'stock/in',
    type: 'post',
    data: { warehouse_id: warehouse_id },
    complete: function(res){
      // do nothing
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
    },
  },
  columns: [
    {
      data: null,
      render: function(data, type, row){
        if(row['stock_in_id'] != null){
          return row['stock_in_material'];
        }
        else{
          return 'no material';
        }
      }
    },
    {data: 'quantity'},
    {data: 'date'},
    {data: 'remarks'},
  ],
});

$(stock_out).DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: 'stock/out',
    type: 'post',
    data: { warehouse_id: warehouse_id },
    complete: function(res){
      // do nothing
    },
    error: function(error){

      // Swal.fire(error.responseText);
      console.log('error');
      console.log(error.responseText);
      alert(error.responseText);
    },
  },
  columns: [
    {
      data: null,
      render: function(data, type, row){
        if(row['stock_out_id'] != null){
          return row['stock_out_material'];
        }
        else{
          return 'no material';
        }
      }
    },
    {data: 'quantity'},
    {data: 'date'},
    {data: 'remarks'},
  ],
});