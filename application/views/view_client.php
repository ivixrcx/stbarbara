<section class="no-padding-bottom">
  <div class="container-fluid">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block">
                        <div class="title pb-2">
                        <h2>Personal Details</h2>
                        <hr/>
                        </div>
                        <!-- Personal Details   -->
                        <div class="form-row">
                            <table style="width:100% !important" class="table table-condensed table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td width="30%">Name:</td>
                                        <td><?php echo ucwords($client[0]->last_name . ', ' . $client[0]->first_name . ' ' . $client[0]->middle_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Occupation:</td>
                                        <td><?php echo $client[0]->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Birth Date:</td>
                                        <td><?php echo $client[0]->birth_date; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Birth Place:</td>
                                        <td><?php echo $client[0]->birth_place; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender:</td>
                                        <td><?php echo $client[0]->gender; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Civil Status:</td>
                                        <td><?php echo $client[0]->civil_status; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Religion:</td>
                                        <td><?php echo $client[0]->religion; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nationality:</td>
                                        <td><?php echo $client[0]->nationality; ?></td>
                                    </tr>
                                    <tr>
                                        <td>TIN:</td>
                                        <td><?php echo $client[0]->tin; ?></td>
                                    </tr>
                                    <tr>
                                        <td>SSS:</td>
                                        <td><?php echo $client[0]->sss; ?></td>
                                    </tr>
                                    <tr>
                                        <td>PAG-IBIG:</td>
                                        <td><?php echo $client[0]->pagibig; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Driver's License:</td>
                                        <td><?php echo $client[0]->drivers_license; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Id Name:</td>
                                        <td><?php echo $client[0]->id_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Id No:</td>
                                        <td><?php echo $client[0]->id_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Issued:</td>
                                        <td><?php echo $client[0]->id_registration_date; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Place Issued:</td>
                                        <td><?php echo $client[0]->id_valid_until; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Place At:</td>
                                        <td><?php echo $client[0]->id_place; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Personal Details   -->
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-12">
                    <div class="block">
                        <div class="title pb-2">
                            <h2>Spouse Details</h2>
                            <hr/>
                        </div>
                        <?php 

                        if(!empty($pouse)){
                        
                        ?>
                        <!-- Spouse Details -->
                        <div class="form-row">
                            <table style="width:100% !important" class="table table-condensed table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td width="30%">Last Name:</td>
                                        <td><?php echo $spouse[0]->last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>First Name:</td>
                                        <td><?php echo $spouse[0]->first_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Middle Name:</td>
                                        <td><?php echo $spouse[0]->middle_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Birth Date:</td>
                                        <td><?php echo $spouse[0]->birth_date; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Birth Place:</td>
                                        <td><?php echo $spouse[0]->birth_place; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Occupation:</td>
                                        <td><?php echo $spouse[0]->occupation; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nationality:</td>
                                        <td><?php echo $spouse[0]->nationality; ?></td>
                                    </tr>
                                    <tr>
                                        <td>TIN:</td>
                                        <td><?php echo $spouse[0]->tin; ?></td>
                                    </tr>
                                    <tr>
                                        <td>SSS:</td>
                                        <td><?php echo $spouse[0]->sss; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pag-Ibig:</td>
                                        <td><?php echo $spouse[0]->pagibig; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Driver's License:</td>
                                        <td><?php echo $spouse[0]->drivers_license; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Id Name:</td>
                                        <td><?php echo $spouse[0]->spouse_id_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Id No:</td>
                                        <td><?php echo $spouse[0]->spouse_id_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Issued:</td>
                                        <td><?php echo $spouse[0]->spouse_id_date_issued; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Place Issued:</td>
                                        <td><?php echo $spouse[0]->spouse_id_place_issued; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <!-- End Spouse Details -->
                        </div>

                        <?php 

                        }

                        else{
                            echo '<p class="text-center">--------- NO INFO ---------</p>';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-6">
            <div class="block">
                <div class="title pb-2">
                    <h2>Contact Information</h2>
                    <hr/>
                </div>
                <!-- Contact Information -->
                <table style="width:100% !important" class="table table-condensed table-striped table-hover">
                    <tbody>
                        <tr>
                            <td width="30%">Residence Address:</td>
                            <td><?php echo $client[0]->residence_address; ?></td>
                        </tr>
                        <tr>
                            <td>Provicial Address:</td>
                            <td><?php echo $client[0]->provincial_address; ?></td>
                        </tr>
                        <tr>
                            <td>Landline No.:</td>
                            <td><?php echo $client[0]->landline_no; ?></td>
                        </tr>
                        <tr>
                            <td>Cellphone No.:</td>
                            <td><?php echo $client[0]->cellphone_no; ?></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td><?php echo $client[0]->email; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Contact Information -->
            </div>
        </div>
    </div>
</section>