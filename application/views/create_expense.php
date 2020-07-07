<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="form" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group autocomplete">
                <input type="hidden" id="category_id" name="category_id" placeholder="" autocomplete="off" class="form-control" required readonly>
                <label>Category</label>
                <input type="text" id="category" name="category" placeholder="" autocomplete="off" class="form-control" required>
              </div>
              <div class="form-group autocomplete">
                <input type="hidden" id="item_id" name="item_id" placeholder="" autocomplete="off" class="form-control" required readonly>
                <label>Item</label>
                <input type="text" id="item" name="item" placeholder="" autocomplete="off" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" name="description" placeholder="" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="number" id="amount" name="amount" step="1" placeholder="" autocomplete="off" class="form-control" required>
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