<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_create_purchase_order" method="POST" autocomplete="off" style="font-size: 16px !important;">
            <div class="form-group">
              <label>Warehouse</label>
              <select id="warehouse_id" name="warehouse_id" class="form-control mb-3 mb-3"></select>
            </div>
            <div class="form-group">
              <label>Vendor</label>
              <select id="supplier_id" name="supplier_id" class="form-control mb-3 mb-3"></select>
            </div>
            <div class="form-group">
              <label>Requested By</label>
              <div class="autocomplete" style="width:300px;">
                <input type="text" id="requested_by" name="requested_by" data-id="" value="" placeholder="" class="form-control">
              </div>
            </div>
            <div class="form-group">       
              <label>Requested Date</label>
              <input type="date" id="requested_date" name="requested_date" placeholder="" class="form-control" value="<?php echo date('Y-m-d') ?>">
            </div>
            <div class="form-group">       
              <label>Note</label>
              <textarea id="user_note" name="user_note" class="form-control"></textarea>
            </div>
            <div class="form-group d-flex justify-content-end">
              <input type="submit" value="Submit" id="btn_create_user" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>