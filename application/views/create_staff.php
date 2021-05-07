<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <div class="block">
          <form id="frm_create_user" method="POST" style="font-size: 16px !important;">
            <div class="modal-body">
              <div class="form-group">
                <label>Last name </label>
                <input type="text" id="last_name" name="last_name" placeholder="Doe" class="form-control">
              </div>
              <div class="form-group">
                <label>First name </label>
                <input type="text" id="first_name" name="first_name" placeholder="John" class="form-control">
              </div>
              <div class="form-group">
                <label>Address </label>
                <input type="text" id="address" name="address" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Contact Number </label>
                <input type="text" id="contact_no" name="contact_no" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Gender </label>
                <select id="gender" name="gender" class="form-control mb-3 mb-3">
                    <option value="1" selected>Male</option>
                    <option value="2">Female</option>
                    <option value="3">Others</option>
                    <option></option>
                </select>
              </div>
              <div class="form-group">
                <label>Birth Date </label>
                <input type="date" id="birth_date" name="birth_date" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Start Date </label>
                <input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d') ?>" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Daily Compensation </label>
                <input type="text" id="daily_compensation" name="daily_compensation" placeholder="" value="0" class="form-control">
              </div>
              <div class="form-group">
                <label>Daily Cola </label>
                <input type="text" id="daily_cola" name="daily_cola" placeholder="" value="0" class="form-control">
              </div>
              <div class="form-group">
                <label>Job Description/Position </label>
                <input type="text" id="job_description" name="job_description" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>SSS </label>
                <input type="text" id="sss" name="sss" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>PagIbig </label>
                <input type="text" id="pagibig" name="pagibig" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>TIN </label>
                <input type="text" id="tin" name="tin" placeholder="" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" value="Submit" id="btn_create_staff" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>