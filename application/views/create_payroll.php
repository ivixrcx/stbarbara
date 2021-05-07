<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <h4 class="title">Payroll for <?php echo ucwords($staff[0]->full_name); ?></h4>
          <form id="frm_create_payroll" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" class="form-control" hidden readonly>
                <label>Pay Date: </label>
                <input type="date" id="paydate" name="paydate" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="project_id">Project:</label>
                <select id="project_id" name="project_id" class="form-control">
                  <option value="0">None</option>
                  <?php 
                    foreach ($projects as $id => $project) {
                      if($staff[0]->project_id == $project->project_id){
                        echo "<option value='$project->project_id' selected>$project->name</option>";
                      }
                      else{
                        echo "<option value='$project->project_id'>$project->name</option>";
                      }
                    }
                  ?>
                </select> 
              </div>
              <div class="form-group">
                <label>No. of days: </label>
                <input type="number" id="no_of_days" name="no_of_days" value="12" minlength="1" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Note: </label>
                <textarea id="note" name="note" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" value="Submit" id="btn_create_payroll" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>