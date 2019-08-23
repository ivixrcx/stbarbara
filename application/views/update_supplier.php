<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <input type="hidden" id="supplier_id" name="supplier_id" placeholder="" class="form-control" value="<?php echo $supplier[0]->supplier_id ?>" required readonly hidden>
              <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" placeholder="" class="form-control" value="<?php echo $supplier[0]->name ?>" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" name="description" placeholder="" class="form-control"value="<?php echo $supplier[0]->description ?>" >
              </div>
              <div class="form-group">
                <label>Address</label>
                <input type="text" id="address" name="address" placeholder="" class="form-control" value="<?php echo $supplier[0]->address ?>" required>
              </div>
              <div class="form-group">
                <label>Contact No.</label>
                <input type="text" id="contact_no" name="contact_no" placeholder="" class="form-control" value="<?php echo $supplier[0]->contact_no ?>" required>
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