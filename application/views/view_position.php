<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5">
        <div class="block">
          <h4 class="title">Users</h4>
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
                
              <?php 
                if( !empty($users) ){
                  foreach( $users as $user ) {?>
                  <tr>
                      <td><?php echo $user->full_name ?></td>
                      <td><a href="user/<?php echo $user->user_id ?>" class="btn btn-primary btn-sm pull-right">View</a></td>
                  </tr>
                  <?php }
                }
                else{
                echo '<tr class="text-center"><td>no data</td></tr>';
                } ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="block">
          <strong class="title">Default Permissions</strong>
          <a href="update/position/permissions/<?php echo $user_type_id ?>" class="btn btn-primary pull-right">Modify</a>          
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
            <?php 
            $module = '';
            foreach( $permissions as $permission ) { ?>
            
            <?php if($module !== $permission->user_module_category_name){ ?>
            <tr style="border-top: 2px solid #4f4f4f;">
            <?php } else{ ?>
                <tr style="border-top:5px solid transparent !important">
            <?php } ?>
                <?php if($module !== $permission->user_module_category_name){ ?>
                <td>
                    <a href="<?php echo 'module-category/' . $permission->user_module_category_id ?>">
                    <u><?php echo $permission->user_module_category_name ?></u>
                    </a>
                </td>
                <?php } 
                else{ ?>
                <td></td>
                <?php } ?>
                <?php $module = $permission->user_module_category_name;?>
                <td><?php echo $permission->user_module_name ?></td>
                <td>
                    <?php 
                    $links = explode(',', $permission->user_module_link ); 
                    if( count($links) > 0 ){
                        foreach($links as $link){
                            echo "<code>" . trim($link) . "</code><br/>";
                        }
                    } 
                    else{
                        echo "<code>" . trim($links[0]) . "</code>";
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>