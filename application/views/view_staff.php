<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5">
        <div class="block">
          <h4 class="title">Personal Information</h4>
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
                <tr>
                    <td>First Name</td>
                    <td><?php echo $staff[0]->first_name ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $staff[0]->last_name ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $staff[0]->address ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo $staff[0]->contact_no ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $staff[0]->gender ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Birth Date</td>
                    <td><?php echo $staff[0]->birth_date ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><?php echo $staff[0]->start_date ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Daily Cola</td>
                    <td><?php echo $staff[0]->daily_cola ?: "-" ?></td>
                </tr>
                <tr>
                    <td>Job Description</td>
                    <td><?php echo $staff[0]->job_description ?: "-" ?></td>
                </tr>
                <tr>
                    <td>SSS</td>
                    <td><?php echo $staff[0]->sss ?: "-" ?></td>
                </tr>
                <tr>
                    <td>PagIbig</td>
                    <td><?php echo $staff[0]->pagibig ?: "-" ?></td>
                </tr>
                <tr>
                    <td>TIN</td>
                    <td><?php echo $staff[0]->tin ?: "-" ?></td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>