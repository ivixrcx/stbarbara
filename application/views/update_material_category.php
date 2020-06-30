<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" id="material_category_id" name="material_category_id" class="form-control" value="<?php echo $material_category_id ?>" required readonly/>
                <label>Particular</label>
                <input type="text" id="particular" name="particular" class="form-control" value="<?php echo $particular ?>"  required/>
              </div>         
              <div class="form-group">
                <label>Priority level (1-10)</label>
                <input type="number" id="priority_level" name="priority_level" step="1" placeholder="" class="form-control" value="<?php echo $priority_level ?>"  required>
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