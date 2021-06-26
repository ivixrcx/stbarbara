<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="warehouse_id" name="warehouse_id" placeholder="" class="form-control" value="<?php echo $warehouse[0]->warehouse_id ?>" required required readonly>
                <label>Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" value="<?php echo $warehouse[0]->name ?>" required>
              </div>
              <div class="form-group">
                <label>Lot Area</label>
                <input type="text" id="location" name="location" placeholder="" class="form-control" value="<?php echo $warehouse[0]->location ?>" required>
              </div>
              <div class="form-group">
                <label>Floor Area</label>
                <input type="text" id="contact_no" name="contact_no" placeholder="" class="form-control" value="<?php echo $warehouse[0]->contact_no ?>" required>
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