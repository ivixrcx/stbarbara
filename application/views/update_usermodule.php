<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="form_submit" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="user_module_id" name="user_module_id" placeholder="" class="form-control" value="<?php echo $user_module_id ?>" hidden readonly required>
              <input type="hidden" id="user_module_category_id" name="user_module_category_id" placeholder="" class="form-control" value="<?php echo $user_module_category_id ?>" hidden readonly required>
              <div class="form-group">
                <label>Module Name</label>
                <input type="text" id="user_module_name" name="user_module_name" placeholder="" class="form-control" value="<?php echo trim( $user_module[0]->user_module_name ) ?>" required>
              </div>
              <div class="form-group">
                <label>Module Link</label> 
                <input type="text" id="user_module_link" name="user_module_link" placeholder="controller/method" class="form-control" value="<?php echo trim( $user_module[0]->user_module_link ) ?>" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="user_module_description" name="user_module_description" placeholder="" value="<?php echo trim( $user_module[0]->user_module_description ) ?>" class="form-control">
              </div>
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>