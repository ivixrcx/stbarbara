<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="block">
          <form id="frm_create_client" class="form-inlines" method="POST" style="font-size: 16px !important;">

            <!-- Personal Details   -->
              <div class="form-group">
                <label>Last name </label>
                <input type="text" id="last_name" name="last_name" placeholder="Doe" class="form-control">
              </div>
              <div class="form-group">
                <label>First name </label>
                <input type="text" id="first_name" name="first_name" placeholder="John" class="form-control">
              </div>
              <div class="form-group">
                <label>Middle name </label>
                <input type="text" id="middle_name" name="middle_name" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Birth Date </label>
                <input type="date" id="birth_date" name="birth_date" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Birth Place </label>
                <input type="text" id="birth_place" name="birth_place" placeholder="" class="form-control">
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
                <label>Civil Status </label>
                <input type="text" id="civil_status" name="civil_status" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Religion </label>
                <input type="text" id="religion" name="religion" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Nationality </label>
                <input type="text" id="nationality" name="nationality" placeholder="" class="form-control">
              </div>              
              <div class="form-group">
                <label>TIN </label>
                <input type="text" id="tin" name="tin" placeholder="" class="form-control">
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
                <label>Driver's License </label>
                <input type="text" id="drivers_license" name="drivers_license" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Occupation </label>
                <input type="text" id="occupation" name="occupation" placeholder="" class="form-control">
              </div>
            <!-- End Personal Details   -->

            <!-- Spouse Details -->
              <div class="form-group">
                <label>Last Name </label>
                <input type="text" id="last_name" name="last_name" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>First Name </label>
                <input type="text" id="first_name" name="first_name" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Middle Name </label>
                <input type="text" id="middle_name" name="middle_name" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Birth Date </label>
                <input type="date" id="birth_date" name="birth_date" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Birth Place </label>
                <input type="text" id="birth_place" name="birth_place" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Occupation </label>
                <input type="text" id="occupation" name="occupation" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Nationality </label>
                <input type="text" id="nationality" name="nationality" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>SSS </label>
                <input type="text" id="sss" name="sss" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>TIN </label>
                <input type="text" id="tin" name="tin" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>PagIbig </label>
                <input type="text" id="pagibig" name="pagibig" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Driver's License </label>
                <input type="text" id="drivers_license" name="drivers_license" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>ID Name </label>
                <input type="text" id="spouse_id_name" name="spouse_id_name" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>ID No. </label>
                <input type="text" id="spouse_id_no" name="spouse_id_no" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Date Issued </label>
                <input type="text" id="spouse_id_date_issued" name="spouse_id_date_issued" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Place Issued </label>
                <input type="text" id="spouse_id_place_issued" name="spouse_id_place_issued" placeholder="" class="form-control">
              </div>
            <!-- End Spouse Details -->

            <!-- Contact Information -->
              <div class="form-group">
                <label>Residence Address </label>
                <input type="text" id="residence_address" name="residence_address" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Provincial Address </label>
                <input type="text" id="provincial_address" name="provincial_address" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Landline Number </label>
                <input type="text" id="landline_no" name="landline_no" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Cellphone Number </label>
                <input type="text" id="cellphone_no" name="cellphone_no" placeholder="" class="form-control">
              </div>
              <div class="form-group">
                <label>Email </label>
                <input type="email" id="email" name="email" placeholder="" class="form-control">
              </div>
            <!-- End Contact Information -->

            <!-- </div> -->
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" id="btn_create_client" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>