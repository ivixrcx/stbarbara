<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="block">
          <h4 class="title">Summary</h4>
          <input type="hidden" id="project_id" value="<?php echo $project[0]->project_id; ?>" hidden readonly/>
          <div class="d-flex pull-right">
          </div>
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
                <tr>
                    <td>Project:</td>
                    <td><?php echo ucwords($project[0]->name) ?: "None" ?></td>
                </tr>
                <tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="block">
          <div class="d-flex pull-left">
            <h4 class="title pr-2 pb-2 pt-2">Staffs</h4>
          </div>
          <div class="d-flex pull-right">
            <a class="pr-2 pb-2 pt-2" href="add/staff-in-project/<?php echo 1; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-plus text-dark"></i></button></a>
          </div>
          <div class="d-flex pull-right">
          </div>
          <div class="table-responsive pt-3">
            <table class="table" id="staffs" style="width:100%"> 
                <th>Name</th>
                <th>Job Description</th>
                <th>Name</th>
                <th></th>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>