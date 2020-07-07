<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="expense_item_id" name="expense_item_id" class="form-control" value="<?php echo $expense_item_id ?>" required readonly/>
                <label>Category</label>
                <input type="text" class="form-control" value="<?php echo $category ?>"  required disabled/>
              </div>
              <div class="form-group">
                <label>Item</label>
                <input type="text" id="description" name="description" class="form-control" value="<?php echo $description ?>"  required/>
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