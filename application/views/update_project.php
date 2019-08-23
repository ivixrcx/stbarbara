<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="project_id" name="project_id" placeholder="" class="form-control" value="<?php echo $project[0]->project_id ?>" required hidden readonly>
                <label>Project Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" value="<?php echo $project[0]->name ?>" required>
              </div>
              <div class="form-group">
                <label>Total Area</label>
                <input type="number" id="total_area" name="total_area" step="0.01" placeholder="" class="form-control" value="<?php echo $project[0]->total_area ?>">
              </div>
              <div class="form-group">
                <label>Total Units</label>
                <input type="number" id="total_units" name="total_units" placeholder="" class="form-control" value="<?php echo $project[0]->total_units ?>" required>
              </div>
              <div class="form-group">
                <label>Location</label>
                <input type="text" id="location" name="location" placeholder="" class="form-control" value="<?php echo $project[0]->location ?>" required>
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