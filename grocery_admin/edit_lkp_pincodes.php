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
      <?php $pincode_id = $_GET['pincode_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 
            //echo "<pre>"; print_r($_POST); die;
            $lkp_state_id = $_POST['lkp_state_id'];
            $lkp_district_id = $_POST['lkp_district_id'];  
            $lkp_city_id = $_POST['lkp_city_id'];
            $pincode = $_POST['pincode'];
            $sql = "UPDATE `grocery_lkp_pincodes` SET lkp_state_id = '$lkp_state_id',lkp_district_id = '$lkp_district_id',lkp_city_id = '$lkp_city_id',pincode = '$pincode' WHERE id = '$pincode_id' ";     
            $result = $conn->query($sql);
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='manage_pincodes.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='manage_pincodes.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Edit Pincodes</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getPincodes = getIndividualDetails('grocery_lkp_pincodes','id',$pincode_id); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <?php $getStates = getAllDataWithStatus('grocery_lkp_states','0');?>
                                <label class="col-sm-3 control-label" for="form-control-9">Select State</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_state_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required onChange="getDistricts(this.value);">
                                      <option value="">--Select State--</option>
                                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                                          <option <?php if($row['id'] == $getPincodes['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $getDistrictsData = getAllDataWithStatus('grocery_lkp_districts','0');?>
                                <label class="col-sm-3 control-label" for="form-control-9">Select District</label>
                                <div class="col-sm-6 col-md-4">
                                    <select name="lkp_district_id" id="lkp_district_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required onChange="getCities(this.value);">
                                      <option value="">--Select District--</option>
                                      <?php while($row = $getDistrictsData->fetch_assoc()) {  ?>
                                          <option <?php if($row['id'] == $getPincodes['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $getCities = getAllDataWithStatus('grocery_lkp_cities','0');?>
                                <label class="col-sm-3 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select name="lkp_city_id" id="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                      <option value="">--Select City--</option>
                                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                                          <option <?php if($row['id'] == $getPincodes['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Pincode</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control valid_mobile_num" id="form-control-3" placeholder="Enter Pincode" name="pincode" required minlength="6" maxlength="6" value="<?php echo $getPincodes['pincode']; ?>">
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
        </div><?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>