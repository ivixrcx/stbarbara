<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <div class="block">
          <div class="d-flex pull-right">
            <a class="pr-2 pb-2 pt-2" href="create/payroll/<?php echo $staff_id; ?>"><button class="btn btn-primary btn-sm">Create Payroll</button></a>
          </div>
          <div class="table-responsive pt-3" style="overflow-y: hidden">
            <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" hidden readonly required/>
            <table id="list_of_payroll" class="table table-condensed table-striped table-hover"> 
              <thead> 
                <tr> 
                  <th>#</th>
                  <th>Pay Date</th>
                  <th>Base Pay</th>
                  <th>Net Pay</th>
                  <th>No. Of Days</th>
                  <th>Daily Compensation</th>
                  <th>Total Additionals</th>
                  <th>Total Deductions</th>
                  <th></th>
                </tr> 
              </thead> 
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="block">
          <div class="d-flex pull-left">
            <h4 class="title pr-2 pb-2 pt-2 text-success mt-1">CASH ADVANCE</h4>
          </div>
          <div class="d-flex pull-left">
            <a class="pr-2 pb-2 pt-2 pl-2" href="create/payroll-cash-advance/<?php echo $staff_id; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-plus text-dark"></i></button></a>
          </div>
          <div class="table-responsive pt-3" style="overflow-y: hidden">
            <table id="list_of_ca" class="table table-condensed table-striped table-hover"> 
              <thead> 
                <tr> 
                  <th>#</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Note</th>
                  <th></th>
                </tr> 
              </thead> 
            </table>
            <hr/>
            <table class="table"> 
              <thead> 
                <tr>
                  <td>Total Cash Advance:</td>
                  <td>Php <?php echo $total_cash_advance; ?></td>
                </tr>
                <tr>
                  <td><h4 class="text-danger">Credit Balance:</h4></td>
                  <td><h4 class="text-danger" style="color:red">Php <?php echo $ca_balance; ?></h4></td>
                </tr>
              </thead> 
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>