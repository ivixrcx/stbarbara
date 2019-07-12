<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <!-- <div class="title">
              <div class="icon"><i class="icon-user-1"></i></div>
            </div> -->
            <strong class="d-block">NUMBER OF USERS</strong>
            <div id="active_users" class="number dashtext-2">#</div>
          </div>
        </div>
      </div>

      <div class="col-md-1 col-sm-6">
        <div id="add_user" class="statistic-block block ">
          <span class="number dashtext-2 text-center" data-toggle="modal" data-target="#create_user_modal" >+</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="block">
          <div class="table-responsive">
            <table id="list_of_active_users" class="table" style="width:100%"> 
              <thead> 
                <tr> 
                  <th>#</th>
                  <th>Name</th>
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


<!-- MODAL -->

<div id="create_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" class="modal fade text-left" style="display: none;" aria-hidden="true">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Create</strong>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
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
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          <input type="submit" value="Submit" id="btn_create_user" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>