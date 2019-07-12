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
                <label>User name </label>
                <input type="text" id="user_name" name="user_name" placeholder="JohnDoe" class="form-control">
              </div>
              <div class="form-group">       
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="**********" class="form-control">
              </div>
              <div class="form-group">       
                <label>Retype Password</label>
                <input type="password" id="r_passsword" name="r_password" placeholder="**********" class="form-control">
              </div>
              <div class="form-group">       
                <label>User Role</label>
                <select id="user_role" name="user_role" class="form-control mb-3 mb-3"></select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" value="Submit" id="btn_create_user" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>