<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" id="expenseId" name="expenseId" placeholder="" class="form-control" value="<?php echo $expense[0]->expense_id ?>" required readonly>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" id="description" name="description" placeholder="" class="form-control" value="<?php echo $expense[0]->description ?>">
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="number" id="amount" name="amount" placeholder="" class="form-control" value="<?php echo $expense[0]->amount ?>" required>
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