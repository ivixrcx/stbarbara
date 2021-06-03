<section class="no-padding-bottom">
  <div class="container-fluid">
    <form id="frm_create_client" method="POST" style="font-size: 16px !important;">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <div class="block">
            <div class="title pb-2">
              <h2>Personal Details</h2>
              <hr/>
            </div>

              <!-- Personal Details   -->
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Last name </label>
                  <input type="text" id="last_name" name="last_name" placeholder="Doe" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label>First name </label>
                  <input type="text" id="first_name" name="first_name" placeholder="John" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label>Middle name </label>
                  <input type="text" id="middle_name" name="middle_name" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Birth Date </label>
                  <input type="date" id="birth_date" name="birth_date" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Birth Place </label>
                  <input type="text" id="birth_place" name="birth_place" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Gender </label>
                  <select id="gender" name="gender" class="form-control mb-3 mb-3">
                      <option value="1" selected>Male</option>
                      <option value="2">Female</option>
                      <option value="3">Others</option>
                      <option></option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Civil Status </label>
                  <input type="text" id="civil_status" name="civil_status" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Religion </label>
                  <input type="text" id="religion" name="religion" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Nationality </label>
                  <input type="text" id="nationality" name="nationality" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">        
                <div class="form-group col-md-3">
                  <label>TIN </label>
                  <input type="text" id="tin" name="tin" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>SSS </label>
                  <input type="text" id="sss" name="sss" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>PagIbig </label>
                  <input type="text" id="pagibig" name="pagibig" placeholder="" class="form-control">
                </div>
              </div>            
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Driver's License </label>
                  <input type="text" id="drivers_license" name="drivers_license" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Occupation </label>
                  <input type="text" id="occupation" name="occupation" placeholder="" class="form-control">
                </div>
              </div>
              <!-- End Personal Details   -->
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <div class="block">
            <div class="title pb-2">
              <h2>Spouse Details</h2>
              <hr/>
            </div>
            <!-- Spouse Details -->
            <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Last Name </label>
                  <input type="text" id="spouse_last_name" name="spouse_last_name" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>First Name </label>
                  <input type="text" id="spouse_first_name" name="spouse_first_name" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Middle Name </label>
                  <input type="text" id="spouse_middle_name" name="spouse_middle_name" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Birth Date </label>
                  <input type="date" id="spouse_birth_date" name="spouse_birth_date" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Birth Place </label>
                  <input type="text" id="spouse_birth_place" name="spouse_birth_place" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Occupation </label>
                  <input type="text" id="spouse_occupation" name="spouse_occupation" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Nationality </label>
                  <input type="text" id="spouse_nationality" name="spouse_nationality" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>SSS </label>
                  <input type="text" id="spouse_sss" name="spouse_sss" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>TIN </label>
                  <input type="text" id="spouse_tin" name="spouse_tin" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>PagIbig </label>
                  <input type="text" id="spouse_pagibig" name="spouse_pagibig" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Driver's License </label>
                  <input type="text" id="spouse_drivers_license" name="spouse_drivers_license" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>ID Name </label>
                  <input type="text" id="spouse_id_name" name="spouse_id_name" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>ID No. </label>
                  <input type="text" id="spouse_id_no" name="spouse_id_no" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Date Issued </label>
                  <input type="text" id="spouse_id_date_issued" name="spouse_id_date_issued" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Place Issued </label>
                  <input type="text" id="spouse_id_place_issued" name="spouse_id_place_issued" placeholder="" class="form-control">
                </div>
              </div>
              <!-- End Spouse Details -->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <div class="block">
            <div class="title pb-2">
              <h2>Contact Information</h2>
              <hr/>
            </div>
            <!-- Contact Information -->
            <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Residence Address </label>
                  <input type="text" id="residence_address" name="residence_address" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Provincial Address </label>
                  <input type="text" id="provincial_address" name="provincial_address" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Landline Number </label>
                  <input type="text" id="landline_no" name="landline_no" placeholder="" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label>Cellphone Number </label>
                  <input type="text" id="cellphone_no" name="cellphone_no" placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Email </label>
                  <input type="email" id="email" name="email" placeholder="" class="form-control">
                </div>
              </div>
              <!-- End Contact Information -->
              
              <div class="modal-footer pt-5">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" id="btn_create_client" class="btn btn-primary">Submit</button>
              </div>
          </div>
          
        </div>
      </div>
    </form>
  </div>
</section>