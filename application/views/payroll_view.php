<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="block">
          <div class="d-flex pull-left">
            <h4 class="title pr-2 pb-2 pt-2">Summary</h4>
          </div>
          <div class="d-flex pull-right">
            <a class="pr-2 pb-2 pt-2" href="payroll/to_print/<?php echo $payroll_id; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-print text-dark"></i></button></a>
          </div>
          <input type="hidden" id="payroll_id" value="<?php echo $payroll[0]->payroll_id; ?>" hidden readonly/>
          <div class="d-flex pull-right">
          </div>
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
                <tr>
                    <td>Project:</td>
                    <td><?php echo ucwords($payroll[0]->project_name) ?: "None" ?></td>
                </tr>
                <tr>
                    <td>Employee Name:</td>
                    <td><?php echo ucwords($payroll[0]->full_name) ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td><?php echo $payroll[0]->job_description ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Pay Date:</td>
                    <td><?php echo date('Y M d', strtotime($payroll[0]->paydate)) ?: "" ?></td>
                </tr>
                <tr>
                    <td>No. of days:</td>
                    <td><?php echo $payroll[0]->no_of_days ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Base Pay:</td>
                    <td><?php echo number_format($payroll[0]->basepay, 2, '.', ',') ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Additionals:</td>
                    <td><?php echo number_format($payroll[0]->total_additionals, 2, '.', ',') ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Deductions:</td>
                    <td><?php echo number_format($payroll[0]->total_deductions, 2, '.', ',') ?: "-" ?></td>
                </tr>
                    <td>Net Pay:</td>
                    <td><?php echo number_format($payroll[0]->net_pay, 2, '.', ',') ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Note:</td>
                    <td><?php echo $payroll[0]->note ?: "---" ?></td>
                </tr>
            </table>
          </div>
        </div>
      </div>
      
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="block">
                <div class="d-flex pull-left">
                  <h4 class="title pr-2 pb-2 pt-2 text-success">Addtional</h4>
                </div>
                <div class="d-flex pull-right">
                  <a class="pr-2 pb-2 pt-2" href="create/payroll-additional/<?php echo $payroll_id; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-plus text-dark"></i></button></a>
                </div>
                <div class="d-flex pull-right">
                </div>
                <div class="table-responsive pt-3">
                  <table class="table" id="t_additional" style="width:100%"> 
                      <th>Date</th>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Note</th>
                      <th></th>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <div class="block">
                <div class="d-flex pull-left">
                  <h4 class="title pr-2 pb-2 pt-2 text-danger">Deduction</h4>
                </div>
                <div class="d-flex pull-right">
                <a class="pr-2 pb-2 pt-2" href="create/payroll-deduction/<?php echo $payroll_id; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-plus text-dark"></i></button></a>
                </div>
                <div class="d-flex pull-right">
                </div>
                <div class="table-responsive pt-3">
                  <table class="table" id="t_deduction" style="width:100%"> 
                      <th>Date</th>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Note</th>
                      <th></th>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row">

    
    </div>
  </div>
</section>