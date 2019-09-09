

/* global declarations */

$('form').validate({
  rules: {
    warehouse_id: {
      required: true,
      digits: true,
    },
    stock_in_id: {
      required: true,
    },
    particular: {
      required: true,
    },
    date: {
      required: true,
      date: true,
    },
    unit: {
      required: true,
    },
    quantity: {
      required: true,
      number: true,
      min: 0.1,
      max: 999,
    },
    remarks: {
      maxlength: 150,
    },
  },
  submitHandler: function(form){
    /**
     * check if material exists
     * 
     */
    if($('#particular').data('exist') == false){ // material !exists
      /**
       * Swal create material form
       * 
       */
      Swal.fire({
        title: 'Create Material',
        html: `
          <form>
          <p>Material "<b class="text-bold">${$('#particular').val()}</b>" not found. Add to material.</p>
          <div class="form-group">
            <label class="pull-left">Category</label>
            <select id="swal_material_category" name="swal_material_category" class="form-control"></select>
          </div>
          <div class="form-group">
            <label class="pull-left">Material</label>
            <input type="text" id="swal_particular" name="swal_particular" value="${$('#particular').val()}" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label class="pull-left">Unit</label>
            <input type="text" id="swal_unit" name="swal_unit" placeholder="eg: kg, liter, gal" class="form-control" value="${$('#unit').val()}"" required readonly>
          </div>
          <div class="form-group">
            <label class="pull-left">Stock level</label>
            <input type="text" id="swal_stock_level" name="swal_stock_level" value="10" class="form-control">
          </div>
          </form>
        `,
        confirmButtonColor: '#429244',
        confirmButtonText: 'Submit',
        cancelButtonColor: '#bb414d',
        cancelButtonText: 'Close',
        showCancelButton: true,
        onBeforeOpen: function(){
          /**
           * category list
           * 
           */
          $.post('materialcategory/list')
          .then(res=>{
            if(res.has_data){
              $.each(res.data, function(key,data){
                $('#swal_material_category').append(new Option(data.particular, data.material_category_id));
              });
            }
          })
          .catch(err=>{
            $('.swal2-content #swal2-content').hide();
            $('.swal2-actions .swal2-confirm').hide();
            Swal.showValidationMessage(err.responseJSON.data.error);
          });
          
          /**
           * modal form validation
           * 
           */
          $('#swal2-content form').validate({
            rules: {
              swal_material_category: {
                required: true,
              },
              swal_particular: {
                required: true,
              },
              swal_unit: {
                required: true,
              },
              required: true,
                swal_stock_level: {
                digits: true,
              }
            }
          });
        },
        preConfirm: function(){
          /**
           * form is valid
           * 
           */
          if($('#swal2-content form').valid()){
            let material_category_id = $('#swal_material_category').val();
            let particular = $('#swal_particular').val();
            let stock_level = $('#swal_stock_level').val();
            let unit = $('#swal_unit').val();
            /**
             * create material
             * 
             */
            $.post('material/create', {
              particular: particular,
              unit: unit,
              stock_level: stock_level,
              material_category_id: material_category_id
            })
            .then(res=>{
              if(res.has_data){
                /**
                 * update #stock_in_id value 
                 * from newly inserted material
                 * 
                 */
                let material_id = res.data;
                $('#stock_in_id').val(material_id);
                /**
                 * stock in
                 * 
                 */
                stock_in();
              }
            })
            .catch(err=>{
              Swal.showValidationMessage(err.responseJSON.data.error);
            });
          }
          /**
           * form is not valid
           * inefficient data
           * 
           */
          else{
            return false;
          }
        }
      });
    }
    else{
      /**
       * stock in
       * 
       */
      stock_in();
    }
  }

});

/**
 * stock in
 * 
 */
let stock_in = function(){
    let warehouse_id = $('#warehouse_id').val();
    let stock_in_id = $('#stock_in_id').val();
    let date = $('#date').val();
    let unit = $('#unit').val();
    let quantity = $('#quantity').val();
    let remarks = $('#remarks').val();

    $.post('stock/create_stock_in',{
      warehouse_id: warehouse_id,
      stock_in_id: stock_in_id,
      date: date,
      unit: unit,
      quantity: quantity,
      remarks: remarks,
    })
    .then(res=>{
      if(res.has_data){
        /**
         * update material number of stocks
         * 
         */
        $.post('material/add_stock',{
          material_id: stock_in_id,
          no_of_stocks: quantity
        })
        .then(res=>{
          Swal.fire({
            type: 'success',
            showConfirmButton: false,
            timer: 2000,
          }).then(function(){
            window.location.href=`view/warehouse/${warehouse_id}`;
          });
        });
      }
    })
    .catch(err=>{
      Swal.showValidationMessage(err.responseJSON.data.error);      
    });
}

$("#particular").keyup(function(){
  // set data-exist to false by default
  $(this).data('exist', false);

  $.post('material/search',{
    particular: $(this).val(),
  })
  .then(res=>{
    if(res.has_data){
      let list = [];
      $.each(res.data, function( key, data ){
        list.push({
            id: data.material_id,
            data: data.particular_unit,
        });
      });

      $('#stock_in_id').on('input', function(){
        $('#unit').attr('readonly', false)
        $('#unit').val('');
      });

      let ac = new autocomplete($("#particular"), list)
      ac.itemSelected((id,val,input)=>{
        // when item is selected it means its exists
        $(this).data('exist', true);

        let name = val.split('/')[0];
        let unit = val.split('/')[1].split(' ')[0];
        
        $('#unit').attr('readonly', true);
        $('#unit').val(unit);
        $('#particular').val(name);
        $('#stock_in_id').val(id);
      });
    }
  })
  .catch(err=>{
    Swal.showValidationMessage(err.responseJSON.data.error);
  });
});

