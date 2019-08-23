<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="house_id" name="house_id" placeholder="" class="form-control" value="<?php echo $house[0]->house_id ?>" required required readonly>
                <label>Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" value="<?php echo $house[0]->name ?>" required>
              </div>
              <div class="form-group">
                <label>Lot Area</label>
                <input type="number" id="lot_area" name="lot_area" step="0.01" placeholder="" class="form-control" value="<?php echo $house[0]->lot_area ?>" required>
              </div>
              <div class="form-group">
                <label>Floor Area</label>
                <input type="number" id="floor_area" name="floor_area" step="0.01" placeholder="" class="form-control" value="<?php echo $house[0]->floor_area ?>" required>
              </div>
              <div class="form-group">
                <label>Suggested Price</label>
                <input type="number" id="suggested_price" name="suggested_price" step="0.01" placeholder="" class="form-control" value="<?php echo $house[0]->suggested_price ?>" required>
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