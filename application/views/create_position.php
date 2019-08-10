<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <form method="POST" style="font-size: 16px !important;">
            <div class="block">
                <div class="form-group">
                    <div class="title text-success">
                        <strong>Position Name</strong>
                    </div>
                    <input type="text" id="name" name="name" placeholder="" class="form-control" required> 
                </div>
            </div>
            <div class="block">
                <div class="form-group">
                    <div class="title text-success">
                        <strong>Default Access Modules</strong>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="w-20">Category</th>
                            <th class="w-20">Module Name</th>
                            <th class="w-50">Link</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // border-top: 3px solid #4f4f4f;
                            $module = '';
                            foreach( $usermodules as $usermodule ) { ?>
                            
                            <?php if($module !== $usermodule->user_module_category_name){ ?>
                            <tr style="border-top: 2px solid #4f4f4f;">
                            <?php } else{ ?>
                                <tr style="border-top:5px solid transparent !important">
                            <?php } ?>
                                <?php if($module !== $usermodule->user_module_category_name){ ?>
                                <td>
                                    <a href="<?php echo 'module-category/' . $usermodule->user_module_category_id ?>">
                                    <u><?php echo $usermodule->user_module_category_name ?></u>
                                    </a>
                                </td>
                                <?php } 
                                else{ ?>
                                <td></td>
                                <?php } ?>
                                <?php $module = $usermodule->user_module_category_name;?>
                                <td><?php echo $usermodule->user_module_name ?></td>
                                <td class="modules" data-id="<?php echo $usermodule->user_module_id ?>">
                                    <?php 
                                    $links = explode(',', $usermodule->user_module_link ); 
                                    if( count($links) > 0 ){
                                        foreach($links as $link){
                                            echo "<code class='module-link'>" . trim($link) . "</code><br/>";
                                        }
                                    } 
                                    else{
                                        echo "<code class='module-link'>" . trim($links[0]) . "</code>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>