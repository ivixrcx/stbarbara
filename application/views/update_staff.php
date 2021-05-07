<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5">
        <div class="block">
            <form id="frm_update_staff" method="POST" style="font-size: 16px !important;">
                <h4 class="title">Personal Information</h4>
                <div class="table-responsive pt-3">
                    <input type="text" class="form-control" id="staff_id" value="<?php echo $staff[0]->staff_id ?>" hidden readonly>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="first_name">First Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" value="<?php echo $staff[0]->first_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="last_name">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="last_name" value="<?php echo $staff[0]->last_name ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address">Address:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" value="<?php echo $staff[0]->address ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact_no">Contact Number:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact_no" value="<?php echo $staff[0]->contact_no ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="gender">Gender:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gender" value="<?php echo $staff[0]->gender ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="gender">Gender:</label>
                        <div class="col-sm-10">
                            <?php 
                                $GenderOptions = array('1' => 'Male', '2' => 'Female', '3' => 'Others');
                                echo form_dropdown('gender', $GenderOptions, $staff[0]->gender,'id="gender" class="form-control" required');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="birth_date">Birthdate:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="birth_date" value="<?php echo $staff[0]->birth_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date">Start Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="start_date" value="<?php echo $staff[0]->start_date ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="daily_compensation">Daily Compensation:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="daily_compensation" value="<?php echo $staff[0]->daily_compensation ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" job_description="email">Job Description:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="job_description" value="<?php echo $staff[0]->job_description ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sss">SSS:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sss" value="<?php echo $staff[0]->sss ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pagibig">PagIbig:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pagibig" value="<?php echo $staff[0]->pagibig ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="tin">TIN:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tin" value="<?php echo $staff[0]->tin ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>