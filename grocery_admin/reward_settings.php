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
          $reward_points = $_POST['reward_points'];
          $reward_type = $_POST['reward_type'];
          $id=1;
          if($_POST['reward_type'] == 1) {
            $category_id = '';
            $sub_category_id = '';
            $product_id = '';
          } elseif($_POST['reward_type'] == 2) {
            $category_id = $_POST['category_id'];
            $sub_category_id = '';
            $product_id = '';
          } elseif($_POST['reward_type'] == 3) {
            $category_id = $_POST['category_id'];
            $sub_category_id = $_POST['sub_category_id'];
            $product_id = '';
          } elseif($_POST['reward_type'] == 4) {
            $category_id = $_POST['category_id'];
            $sub_category_id = $_POST['sub_category_id'];
            $product_id = $_POST['product_id'];
          }

          $sql = "UPDATE `grocery_reward_settings` SET reward_type = '$reward_type', reward_points= '$reward_points', category_id = '$category_id', sub_category_id='$sub_category_id', product_id = '$product_id' WHERE id = '$id' ";
          if($conn->query($sql) === TRUE){
             echo "<script type='text/javascript'>window.location='reward_settings.php?msg=success'</script>";
          } else {
             echo "<script type='text/javascript'>window.location='reward_settings.php?msg=fail'</script>";
          }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Reward Points</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $transactionAmount = getIndividualDetails('grocery_reward_points','id',1); ?>
                        <?php $rewardSettings = getIndividualDetails('grocery_reward_settings','id',1); ?>
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Reward Type</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="reward_type" name="reward_type" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Reward Type --</option>
                                        <option <?php if($rewardSettings['reward_type'] == 1) { echo "Selected"; } ?> value="1" >Global</option>
                                        <option <?php if($rewardSettings['reward_type'] == 2) { echo "Selected"; } ?> value="2" >Category</option>
                                        <option <?php if($rewardSettings['reward_type'] == 3) { echo "Selected"; } ?> value="3" >Sub Category</option>
                                        <option <?php if($rewardSettings['reward_type'] == 4) { echo "Selected"; } ?> value="4" >Product</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="cat_id" name="category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }"  onChange="getSubCategories(this.value);" >
                                        <option value="">-- Select Category --</option>
                                        <?php $getCategories = getAllDataWithStatus('grocery_category','0');?>
                                        <?php while($row = $getCategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $rewardSettings['category_id']) { echo "Selected"; }?> value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group sub_category">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Sub Category</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="sub_cat_id" name="sub_category_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }"  onChange="getProducts(this.value);" >
                                        <option value="">-- Select Sub Category --</option>
                                        <option <?php if($rewardSettings['sub_category_id'] == 'all') { echo "Selected"; } ?> value="all" >All</option>
                                        <?php $getSubCategories = getAllDataWithStatus('grocery_sub_category','0');?>
                                        <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                                            <option <?php if($row['id'] == $rewardSettings['sub_category_id']) { echo "Selected"; }?> value="<?php echo $row['id']; ?>" ><?php echo $row['sub_category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group product">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select Product</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="product_id" name="product_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" >
                                        <option value="">-- Select Product --</option>
                                        <option <?php if($rewardSettings['product_id'] == 'all') { echo "Selected"; } ?> value="all" >All</option>
                                        <?php $geyProducts = getAllDataWithStatus('grocery_products','0');?>
                                        <?php while($row = $geyProducts->fetch_assoc()) {  
                                            $getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$row['id']);
                                        ?>
                                            <option <?php if($row['id'] == $rewardSettings['product_id']) { echo "Selected"; }?> value="<?php echo $row['id']; ?>" ><?php echo $getProductName['product_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Transaction Amount</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" readonly name="transaction_amount" class="form-control" id="form-control-3" placeholder="Enter Transaction Amount" value="<?php echo $transactionAmount['transaction_amount']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Reward Points</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="reward_points" class="form-control" id="form-control-3" placeholder="Enter Reward Points" value="<?php echo $rewardSettings['reward_points']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
    <script type="text/javascript">
        function getSubCategories(val) { 
            $.ajax({
            type: "POST",
            url: "get_sub_categories.php",
            data:'cat_id='+val,
            success: function(data){
                $("#sub_cat_id").html(data);
            }
            });
        }
        function getProducts(val) { 
            $.ajax({
            type: "POST",
            url: "get_products.php",
            data:'sub_cat_id='+val,
            success: function(data){
                $("#product_id").html(data);
            }
            });
        }
    </script>
    <script type="text/javascript">
        $(".category,.sub_category,.product").hide();
        $("#cat_id,#sub_cat_id,#product_id").removeAttr('required');
        $("#reward_type").change(function() {
            if($(this).val() == 2) {
                $(".category").show();
                $(".sub_category").hide();
                $(".product").hide();
                $("#cat_id").attr("required", "true");
                $("#cat_id").val('');
                $("#sub_cat_id,#product_id").removeAttr('required');
            } else if($(this).val() == 3) {
                $(".category").show();
                $(".sub_category").show();
                $(".product").hide();
                $("#cat_id,#sub_cat_id").val('');
                $("#cat_id,#sub_cat_id").attr("required", "true");
                $("#product_id").removeAttr('required');
            } else if($(this).val() == 4) {
                $(".category").show();
                $(".sub_category").show();
                $(".product").show();
                $("#cat_id,#sub_cat_id,#product_id").val('');
                $("#cat_id,#sub_cat_id,#product_id").attr("required", "true");
            } else {
                $(".category").hide();
                $(".sub_category").hide();
                $(".product").hide();
                $("#cat_id,#sub_cat_id,#product_id").removeAttr('required');
            }
        });
        if($('#reward_type').val() == 2) {
            $(".category").show();
            $(".sub_category").hide();
            $(".product").hide();
            $("#cat_id").attr("required", "true");
            $("#sub_cat_id,#product_id").removeAttr('required');
        } else if($('#reward_type').val() == 3) {
            $(".category").show();
            $(".sub_category").show();
            $(".product").hide();
            $("#cat_id,#sub_cat_id").attr("required", "true");
            $("#product_id").removeAttr('required');
        } else if($('#reward_type').val() == 4) {
            $(".category").show();
            $(".sub_category").show();
            $(".product").show();
            $("#cat_id,#sub_cat_id,#product_id").attr("required", "true");
        } else {
            $(".category").hide();
            $(".sub_category").hide();
            $(".product").hide();
            $("#cat_id,#sub_cat_id,#product_id").removeAttr('required');
        }
    </script>
  </body>
</html>