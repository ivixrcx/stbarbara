<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="user_module_category_id" name="user_module_category_id" placeholder="" class="form-control" value="<?php echo $category[0]->user_module_category_id ?>" required hidden readonly>
                <label>Category Name</label>
                <input type="text" id="user_module_category_name" name="user_module_category_name" placeholder="" class="form-control" value="<?php echo $category[0]->user_module_category_name ?>" required>
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