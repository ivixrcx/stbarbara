<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="user_type_id" name="user_type_id" placeholder="" class="form-control" value="<?php echo $position[0]->user_type_id ?>" hidden readonly required>
              <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" value="<?php echo trim( $position[0]->name ) ?>" required>
              </div>
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary btn-block mt-4">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>