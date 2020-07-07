<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="form" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group autocomplete">
                <input type="hidden" id="categoryId" name="categoryId" placeholder="" autocomplete="off" class="form-control" required>
                <label>Category</label>
                <input type="text" id="category" name="category" placeholder="" autocomplete="off" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Item</label>
                <input type="text" id="item" name="item" placeholder="" autocomplete="false" class="form-control" required>
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