<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="form" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <label>Project</label>
                <div class="input-group">
                <input type="hidden" id="project_id" name="project_id" placeholder="" autocomplete="off" class="form-control" readonly>
                  <input type="text" id="project" name="project" placeholder="" autocomplete="off" class="form-control" data-toggle="modal" data-target="#projectModal" required readonly >
                  <button type="button" class="btn bg-transparent btn-clear" style="margin-left: -40px; z-index: 100;">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="form-group">
                <label>Category</label>
                <div class="input-group">
                  <input type="hidden" id="category_id" name="category_id" placeholder="" autocomplete="off" class="form-control" required readonly>
                  <input type="text" id="category" name="category" placeholder="" autocomplete="off" class="form-control" data-toggle="modal" data-target="#categoryModal" required readonly >
                  <button type="button" class="btn bg-transparent btn-clear" style="margin-left: -40px; z-index: 100;">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="form-group autocomplete">
                <input type="hidden" id="item_id" name="item_id" placeholder="" autocomplete="off" class="form-control" required readonly>
                <label>Item</label>
                <input type="text" id="item" name="item" placeholder="" autocomplete="off" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" name="description" placeholder="" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label>Note</label>
                <input type="text" id="note" name="note" placeholder="" autocomplete="off" class="form-control" required>
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

<div class="modal" id="categoryModal">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Choose</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="table-responsive pt-3">
          <table id="list_category" class="table" style="width:100%"> 
            <thead> 
              <tr> 
                <th>Description</th>
                <th></th>
              </tr> 
            </thead> 
          </table>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="projectModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Choose</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="table-responsive pt-3">
            <table id="list_project" class="table" style="width:100%"> 
              <thead> 
                <tr> 
                  <th>Project Name</th>
                  <th></th>
                </tr> 
              </thead> 
            </table>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</section>

