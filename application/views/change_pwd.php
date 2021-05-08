<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_change_pwd" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo  base64_encode(base64_encode(base64_encode($login_data->user_id))); ?>" class="form-control" hidden readonly>
              <div class="form-group">
                <label>Current Password: </label>
                <input type="text" id="current_pwd" name="current_pwd" class="form-control" required>
              </div>
              <hr class="pt-2 pb-2"/>
              <div class="form-group">
                <label>New Password: </label>
                <input type="text" id="new_pwd" name="new_pwd" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Retype New Password: </label>
                <input type="text" id="rnew_pwd" name="rnew_pwd"  class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" id="btn_change_pwd" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>