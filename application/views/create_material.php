<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <label>Material Category</label>
                <input type="hidden" id="material_category_id" name="material_category_id" class="form-control" hidden readonly required />
                <div class="autocomplete" style="width:300px;">
                  <input type="text" id="material_category" name="material_category" class="form-control" required/>
                </div>
              </div>
              <div class="form-group">
                <label>Material Name</label>
                <div class="autocomplete" style="width:300px;">
                  <input type="text" id="particular" name="particular" placeholder="" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label>Unit</label>
                <input type="text" id="unit" name="unit" placeholder="eg: kg, liter, gal" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Minimum Stock Level</label>
                <input type="number" id="stock_level" name="stock_level" step="1" placeholder="" class="form-control" value="10" required>
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