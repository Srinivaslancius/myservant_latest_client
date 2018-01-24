<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>

      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 
            //echo "<pre>"; print_r($_POST); die;
            $product_name = $_REQUEST['product_name'];            
            $grocery_category_id = $_REQUEST['grocery_category_id'];
            $grocery_sub_category_id = $_REQUEST['grocery_sub_category_id'];
            $product_description = $_REQUEST['product_description'];
            $tags = $_REQUEST['tags'];      
            $created_at = date("Y-m-d h:i:s");      

            $sql = "INSERT INTO grocery_products (`grocery_category_id`, `grocery_sub_category_id`, `product_description`, `created_at` ) VALUES ('$grocery_category_id', '$grocery_sub_category_id', '$product_description', '$created_at')";
            $result = $conn->query($sql);
            $last_id = $conn->insert_id;

            $brands = $_REQUEST['brands'];
            foreach($brands as $key=>$value){
                if(!empty($value)) {
                    $brandsType = $_REQUEST['brands'][$key];          
                    $sql = "INSERT INTO grocery_product_bind_brands ( `product_id`,`brand_id`) VALUES ('$last_id','$brandsType')";
                    $conn->query($sql);
                }
            }

            $language_id = $_REQUEST['language_id'];
            foreach($language_id as $key=>$value){
                if(!empty($value)) {
                    $product_name = $_REQUEST['product_name'][$key]; 
                    $product_lang_ids = $_REQUEST['language_id'][$key];         
                    $sql = "INSERT INTO grocery_product_name_bind_languages ( `product_id`,`product_name`, `product_languages_id`) VALUES ('$last_id','$product_name', '$product_lang_ids')";
                    $conn->query($sql);
                }
            }

            $tags = $_REQUEST['tags'];
            foreach($tags as $key=>$value){
                if(!empty($value)) {
                    $tagName = $_REQUEST['tags'][$key];                   
                    $sql = "INSERT INTO grocery_product_bind_tags ( `product_id`,`tag_id`) VALUES ('$last_id','$tagName')";
                    $conn->query($sql);
                }
            }
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='manage_products.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='manage_products.php?msg=fail'</script>";
            }
        }
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Products</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off">                            

                            <?php 
                            $getLanguages = getAllDataWithStatus('grocery_languages','0');
                            ?>
                            <?php while($getLang = $getLanguages->fetch_assoc()) { ?>
                                <div class="form-group">
                                    <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Product Name (<?php echo $getLang['language_name']; ?>)</label>
                                        <div class="col-sm-4 col-md-4">
                                            <input type="text" class="form-control" id="form-control-3" placeholder="Enter Title" name="product_name[]" required>
                                            <input type="hidden" class="form-control" id="form-control-3" placeholder="Language" name="language_id[]" value="<?php echo $getLang['id']; ?>">
                                        </div>                                        
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="grocery_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="grocery_sub_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Sub Category --</option>
                                        <?php $getSubCategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Product Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" class="form-control" rows="3" name="product_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-1" class="col-sm-3 col-md-4 control-label">Brands Applicable</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select id="form-control-2" name="brands[]" class="form-control" data-plugin="select2" multiple="multiple" >
                                            <?php $getBrands = getAllDataWithStatus('grocery_brands','0');
                                            while($row = $getBrands->fetch_assoc()) {  ?>
                                                <option value="<?php echo $row['id']; ?>" ><?php echo $row['brand_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Tags</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-2" name="tags[]" class="form-control" data-plugin="select2" multiple="multiple" >
                                        <?php $getTags = getAllDataWithStatus('grocery_tags','0');
                                        while($row = $getTags->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['tag_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear_fix"></div>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Products</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>    
                                    <th>Product Name</th>                                
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Update Price</th>
                                    <th>Upload Images</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <!-- <th>Hot Deals</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getProdDet = getAllDataWithActiveRecent('grocery_products'); $i=1; ?>
                                <?php while ($row = $getProdDet->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>   
                                    <?php 
                                    $pid = $row['id'];
                                    $getProName = "SELECT * FROM grocery_product_name_bind_languages WHERE product_id='$pid' "; 
                                    $getPn = $conn->query($getProName);
                                    $getProName_new = $getPn->fetch_assoc();
                                    ?>
                                    <td><?php echo $getProName_new['product_name']; ?></td>                                 
                                    <?php $catNAme = getIndividualDetails('grocery_category','id',$row['grocery_category_id']); ?>
                                    <td><?php echo $catNAme['category_name']; ?></td>
                                    <?php $subcatNAme = getIndividualDetails('grocery_sub_category','id',$row['grocery_sub_category_id']); ?>
                                    <td><?php echo $subcatNAme['sub_category_name']; ?></td>

                                    <td><a href="update_price.php?pid=<?php echo $row['id']; ?>">Update Price</a></td>
                                    <td><a href="product_images.php?pid=<?php echo $row['id']; ?>">Upload Images</a></td>

                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_products'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_products'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_testimonials.php?cid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>

                                    <!-- <?php if($row['deal_start_date']!='0000-00-00 00:00:00' && $row['deal_start_time']!='0000-00-00 00:00:00' && $row['deal_end_date']!='0000-00-00 00:00:00' && $row['deal_end_time']!='0000-00-00 00:00:00') { ?>
                                    <td><a href="edit_deal_dates.php?cid=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#<?php echo $row['id']; ?>"><i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i></a></td>
                                    <?php } else { ?>
                                    <td><a href="edit_deal_dates.php?cid=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#<?php echo $row['id']; ?>"><i class="zmdi zmdi-close zmdi-hc-fw"></i></a></td>
                                        <?php }?> -->
                                   

                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        

    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>