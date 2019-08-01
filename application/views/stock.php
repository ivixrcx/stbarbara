<input type="hidden" id="warehouse_id" value="<?php echo $warehouse_id ?>" hidden/>
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
      
         <ul class="nav nav-tabs row no-gutters col-xs-12 col-sm-6 col-md-8" id="myTab" role="tablist">
          <li class="nav-item col-4 col-sm-3">
            <a class="nav-link active text-center" id="stock-all-tab" data-toggle="tab" href="#stock-all" role="tab" aria-controls="stock-all" aria-selected="true">All</a>
          </li>
          <li class="nav-item col-4 col-sm-3">
            <a class="nav-link text-success text-center" id="stock-in-tab" data-toggle="tab" href="#stock-in" role="tab" aria-controls="stock-in" aria-selected="false">Stock In</a>
          </li>
          <li class="nav-item col-4 col-sm-3 col-md-2">
            <a class="nav-link text-danger text-center" id="stock-out-tab" data-toggle="tab" href="#stock-out" role="tab" aria-controls="stock-out" aria-selected="false">Stock Out</a>
          </li>
        </ul>
        <div class="block tab-content">
          <!-- create button -->
          <div class="d-flex pull-right">
              <a class="pr-2 pb-2 pt-2" href="create/stock-in/<?php echo $warehouse_id ?>"><button class="btn btn-primary btn-block">Stock In</button></a>
              <a class="pr-2 pb-2 pt-2" href="create/stock-out/<?php echo $warehouse_id ?>"><button class="btn btn-danger btn-block">Stock Out</button></a>
          </div>

          <!-- all stocks -->
          <div class="tab-pane fade show active" id="stock-all" role="tabpanel" aria-labelledby="stock-all-tab">
            <div class="table-responsive pt-3">
              <table id="list_stock_all" class="table" style="width:100%"> 
                <thead> 
                  <tr> 
                    <th>Material</th>
                    <th>Qty.</th>
                    <th>Date</th>
                    <th>Remarks</th>
                  </tr> 
                </thead> 
              </table>
            </div>
          </div>
          <!-- end all stocks -->

          <!-- stocks in -->
          <div class="tab-pane fade show" id="stock-in" role="tabpanel" aria-labelledby="stock-in-tab">
            <div class="table-responsive pt-3">
              <table id="list_stock_in" class="table" style="width:100%"> 
                <thead> 
                  <tr> 
                    <th>Material</th>
                    <th>Qty.</th>
                    <th>Date</th>
                    <th>Remarks</th>
                  </tr> 
                </thead> 
              </table>
            </div>
          </div>
          <!-- end stocks in -->

          <!-- stocks out -->
          <div class="tab-pane fade show" id="stock-out" role="tabpanel" aria-labelledby="stock-out-tab">
            <div class="table-responsive pt-3">
              <table id="list_stock_out" class="table" style="width:100%"> 
                <thead> 
                  <tr> 
                    <th>Material</th>
                    <th>Qty.</th>
                    <th>Date</th>
                    <th>Remarks</th>
                  </tr> 
                </thead> 
              </table>
            </div>
          </div>
          <!-- end stocks out -->

        </div>
      </div>
    </div>
  </div>
</section>