<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_create_payroll_additional" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="payroll_id" name="payroll_id" value="<?php echo $payroll_id; ?>" class="form-control" hidden readonly>
                <label>Type: </label>
                <select id="type_id" name="type_id" class="form-control" required>
                    <option value="2">Overtime</option>
                    <option value="1">Bonus</option>
                    <option value="4">Others</option>
                    <option value="5">Override Cash</option>
                    <option value="7">Holiday</option>
                    <option value="3">Referral Fee</option>
                </select>
              </div>
              <div class="form-group">
                <label>Date: </label>
                <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Amount: </label>
                <input type="number" id="amount" name="amount" minlength="1" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Note: </label>
                <textarea id="note" name="note" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" value="Submit" id="btn_create_payroll_additional" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>