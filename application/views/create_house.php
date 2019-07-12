<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_add_house" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Lot Area</label>
                <input type="number" id="lot_area" name="lot_area" step="0.01" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Floor Area</label>
                <input type="number" id="floor_area" name="floor_area" step="0.01" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Suggested Price</label>
                <input type="number" id="suggested_price" name="suggested_price" step="0.01" placeholder="" class="form-control" required>
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