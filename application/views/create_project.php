<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_add_project" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <label>Project Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Total Area</label>
                <input type="number" id="total_area" name="total_area" step="0.01" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Total Units</label>
                <input type="number" id="total_units" name="total_units" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Location</label>
                <input type="text" id="location" name="location" placeholder="" class="form-control" required>
              </div>
              <div class="form-group">
                <button type="reset" data-dismiss="modal"class="btn btn-danger">Reset</button>
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>