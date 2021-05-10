<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <div class="block">
          <div class="d-flex pull-right">
            <a class="pr-2 pb-2 pt-2" href="create/payroll/<?php echo $staff_id; ?>"><button class="btn btn-primary btn-sm">Create Payroll</button></a>
          </div>
          <div class="d-flex pull-right">
          </div>
          <div class="table-responsive pt-3" style="overflow-y: hidden">
            <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $staff_id; ?>" hidden readonly required/>
            <table id="list_of_payroll" class="table"> 
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
  </div>
</section>