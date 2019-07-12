<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_add_item" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="purchase_order_id" name="purchase_order_id" value="<?php echo $purchase_order_id ?>" placeholder="" class="form-control" readonly hidden required>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" name="description" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="" min="0.1" max="100" step="0.1" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Unit Price</label>
                <input type="number" id="unit_price" name="unit_price" placeholder="" step="0.01" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Total</label>
                <input type="number" id="total" name="total" placeholder="" step="0.01" class="form-control" required readonly>
              </div>
              <div class="form-group">
                <button type="reset" data-dismiss="modal"class="btn btn-danger">Reset</button>
                <input type="submit" value="Submit" id="btn_add_item" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>