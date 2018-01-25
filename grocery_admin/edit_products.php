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
        $product_id = $_GET['product_id'];
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

            $updateProducts = "UPDATE `grocery_products` SET grocery_category_id = '$grocery_category_id',grocery_sub_category_id = '$grocery_sub_category_id', product_description = '$product_description' WHERE id = '$product_id' ";
            $result = $conn->query($updateProducts);

            $deleteBrands = "DELETE FROM grocery_product_bind_brands WHERE product_id = '$product_id'";
            $conn->query($deleteBrands);
            $brands = $_REQUEST['brands'];
            foreach($brands as $key=>$value){
                if(!empty($value)) {
                    $brandsType = $_REQUEST['brands'][$key];          
                    $sql = "INSERT INTO grocery_product_bind_brands ( `product_id`,`brand_id`) VALUES ('$product_id','$brandsType')";
                    $conn->query($sql);
                }
            }   

            $language_id = $_REQUEST['language_id'];
            foreach($language_id as $key=>$value){
                if(!empty($value)) {
                    $product_name = $_REQUEST['product_name'][$key]; 
                    $product_lang_ids = $_REQUEST['language_id'][$key];
                    $id = $_REQUEST['id'][$key];
                    $updateNames = "UPDATE `grocery_product_name_bind_languages` SET product_name = '$product_name' WHERE product_id = '$product_id' AND product_languages_id = '$product_lang_ids'  AND id = '$id' " ;  
                    $conn->query($updateNames);
                }
            }

            $deleteTags = "DELETE FROM grocery_product_bind_tags WHERE product_id = '$product_id'";
            $conn->query($deleteTags);
            $tags = $_REQUEST['tags'];
            foreach($tags as $key=>$value){
                if(!empty($value)) {
                    $tagName = $_REQUEST['tags'][$key];                   
                    $sql = "INSERT INTO grocery_product_bind_tags ( `product_id`,`tag_id`) VALUES ('$product_id','$tagName')";
                    $conn->query($sql);
                }
            }
                //echo 1; die;
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
                    <h3 class="m-y-0 font_sz_view">Edit Products</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off">                            
                            <?php $getProducts = getIndividualDetails('grocery_products','id',$product_id);
                            $getLanguages = getAllDataWithStatus('grocery_languages','0');
                            ?>
                            <?php while($getLang = $getLanguages->fetch_assoc()) { 
                                $productName = "SELECT * FROM grocery_product_name_bind_languages WHERE product_languages_id = '".$getLang['id']."' AND product_id = '$product_id'";
                                $productName1 = $conn->query($productName);
                                $name = $productName1->fetch_assoc();
                            ?>
                                <div class="form-group">
                                    <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Product Name (<?php echo $getLang['language_name']; ?>)</label>
                                        <div class="col-sm-4 col-md-4">
                                            <input type="text" class="form-control" id="form-control-3" placeholder="Enter Title" name="product_name[]" value="<?php echo $name['product_name']; ?>" required>
                                            <input type="hidden" class="form-control" id="form-control-3" placeholder="Language" name="language_id[]" value="<?php echo $getLang['id']; ?>">
                                            <input type="hidden" class="form-control" id="form-control-3" placeholder="Language" name="id[]" value="<?php echo $name['id']; ?>">
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
                                            <option <?php if($row['id'] == $getProducts['grocery_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
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
                                            <option <?php if($row['id'] == $getProducts['grocery_sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Product Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" class="form-control" rows="3" name="product_description"><?php echo $getProducts['product_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-1" class="col-sm-3 col-md-4 control-label">Brands Applicable</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select id="form-control-2" name="brands[]" class="form-control" data-plugin="select2" multiple="multiple" >
                                            <?php $getBrands = getAllDataWithStatus('grocery_brands','0');
                                            while($row = $getBrands->fetch_assoc()) {  
                                                $BrandName = "SELECT * FROM grocery_product_bind_brands WHERE brand_id = '".$row['id']."' AND product_id = '$product_id'";
                                                $BrandName1 = $conn->query($BrandName);
                                                $name = $BrandName1->fetch_assoc();
                                            ?>
                                                <option <?php if($row['id'] == $name['brand_id']) { echo "selected=selected"; }?> value="<?php echo $row['id']; ?>" ><?php echo $row['brand_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Tags</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-2" name="tags[]" class="form-control" data-plugin="select2" multiple="multiple" >
                                        <?php $getTags = getAllDataWithStatus('grocery_tags','0');
                                        while($row = $getTags->fetch_assoc()) {  
                                            $tageName = "SELECT * FROM grocery_product_bind_tags WHERE tag_id = '".$row['id']."' AND product_id = '$product_id'";
                                            $tageName1 = $conn->query($tageName);
                                            $name = $tageName1->fetch_assoc();
                                        ?>
                                            <option <?php if($row['id'] == $name['tag_id']) { echo "selected=selected"; }?> value="<?php echo $row['id']; ?>" ><?php echo $row['tag_name']; ?></option>
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
        </div>
    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>