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
	<style>
	#ui-datepicker-div{
		top:146.483px !important;
	}
	</style>
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
                    $search_tags = $_REQUEST['search_tags'];
                    $sql = "INSERT INTO grocery_product_name_bind_languages ( `product_id`,`product_name`, `product_languages_id`, `search_tags`) VALUES ('$last_id','$product_name', '$product_lang_ids', '$search_tags')";
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
                                    <select id="category_id" name="grocery_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" onChange="getSubCategories(this.value);" required>
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
                                    <select id="sub_category_id" name="grocery_sub_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Sub Category --</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Product Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" class="form-control" rows="3" name="product_description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-1" class="col-sm-3 col-md-4 control-label">Brands Applicable</label>
                                    <div class="col-sm-6 col-md-4">
                                        <select id="form-control-2" name="brands[]" class="form-control" data-plugin="select2" multiple="multiple">
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
                                    <select id="form-control-2" name="tags[]" class="form-control" data-plugin="select2" multiple="multiple">
                                        <?php $getTags = getAllDataWithStatus('grocery_tags','0');
                                        while($row = $getTags->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['tag_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Search Tags</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" class="form-control" rows="3" name="search_tags" required></textarea>
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
    <script type="text/javascript">
      $('input.date-pick').datepicker({minDate: 0, maxDate: "+2M"});
    </script>
  </body>
</html>