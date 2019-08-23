<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-warning active" id="approval-purchase-order-tab" data-toggle="tab" href="#approval-purchase-order" role="tab" aria-controls="approval-purchase-order" aria-selected="false">For approval</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" id="approved-purchase-order-tab" data-toggle="tab" href="#approved-purchase-order" role="tab" aria-controls="approved-purchase-order" aria-selected="true">Approved</a>
          </li>
        </ul>

        <div class="block tab-content">

          <div class="d-flex justify-content-end pr-2 pb-3">
            <a href="create/purchase-order" class="col-xs-12 col-sm-2 col-md-2 btn btn-primary btn-primary btn-sm">Create</a>
          </div>

          <!-- approved -->
          <div class="tab-pane fade show" id="approved-purchase-order" role="tabpanel" aria-labelledby="approved-purchase-order-tab">
            <div class="table-responsive">
              <table id="list_of_approved_purchase_orders" class="table responsive nowrap" style="width:100%"> 
                <thead> 
                  <tr> 
                    <th>Request by</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th></th>
                  </tr> 
                </thead> 
              </table>
            </div>
          </div>

          <!-- approval -->
          <div class="tab-pane fade show active" id="approval-purchase-order" role="tabpanel" aria-labelledby="approval-purchase-order-tab">
            <div class="table-responsive">
              <table id="list_of_approval_purchase_orders" class="table responsive nowrap" style="width:100%"> 
                <thead> 
                  <tr> 
                    <th>Request by</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th></th>
                  </tr> 
                </thead> 
              </table>
            </div>
          </div>
          
        </div>
          
      </div>
    </div>
  </div>
</section>