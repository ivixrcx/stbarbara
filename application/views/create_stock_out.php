<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_add_stock_out" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="warehouse_id" name="warehouse_id" value="<?php echo $warehouse_id ?>" required>
              <div class="form-group">
                <label>Material</label>
                <div class="autocomplete" style="width:300px;">
                  <input type="text" id="stock_out_id" name="stock_out_id" placeholder=""  data-id="" value="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label>Date</label>
                <input type="date" id="date" name="date" placeholder="" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" id="quantity" name="quantity" step="0.01" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Remarks</label>
                <input type="text" id="remarks" name="remarks" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <button type="reset" class="btn btn-danger">Reset</button>
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>