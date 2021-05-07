
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <h4 class="title">Add Staff in Project (<?php echo $project[0]->name; ?>)</h4>
          <form id="frm_add_staff_in_project" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
                <div class="form-group">
                    <label>Name: <small style="color: #bbb !important">(search by lastname)</small></label>
                    <input type="hidden" id="project_id" name="project_id" class="form-control" value="<?php echo $project[0]->project_id; ?>" hidden readonly required>
                    <input type="hidden" id="staff_id" name="staff_id" class="form-control" hidden readonly required>
                    <div class="autocomplete" style="width:300px;">
                        <input type="text" id="staff" name="staff" class="form-control" data-exist="false" autocomplete="off" required>
                    </div>
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