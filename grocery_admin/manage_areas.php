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
            $lkp_state_id = $_POST['lkp_state_id'];
            $lkp_district_id = $_POST['lkp_district_id'];
            $lkp_city_id = $_POST['lkp_city_id'];
            $lkp_pincode_id = $_POST['lkp_pincode_id'];
            $area_name = $_REQUEST['area_name'];
            foreach($area_name as $key=>$value){
                if(!empty($value)) {
                  $area_name = $_REQUEST['area_name'][$key];    
                  $sql = "INSERT INTO grocery_lkp_areas (`lkp_state_id`,`lkp_district_id`,`lkp_city_id`,`lkp_pincode_id`,`area_name`) VALUES ('$lkp_state_id','$lkp_district_id','$lkp_city_id','$lkp_pincode_id','$area_name')";
                  $result = $conn->query($sql);
                }
            }
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='manage_areas.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='manage_areas.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Areas</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select State</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_state_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" onChange="getDistricts(this.value);" required>
                                        <option value="">-- Select State --</option>
                                        <?php $getStates = getAllDataWithStatus('grocery_lkp_states','0');?>
                                        <?php while($row = $getStates->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['state_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select District</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_district_id" name="lkp_district_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" onChange="getCities(this.value);" required>
                                        <option value="">-- Select District --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_city_id" name="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" onChange="getPincodes(this.value);" required>
                                        <option value="">-- Select City --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Select Pin Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_pincode_id" name="lkp_pincode_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Pin Code --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clear_fix"></div>
                            <div class="input_fields_container">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Area Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="area_name[]" class="form-control" id="form-control-3" placeholder="Enter Area Name" required>
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <span><button type="button" class="btn btn-success add_more_button"> <i class="zmdi zmdi-plus-circle zmdi-hc-fw"></i></button></span>
                                </div>
                            </div>
                            </div>
                            <div class="clear_fix"></div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Areas</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Area Id</th> -->
                                    <th>Area Name</th>
                                    <th>Pin code</th>
                                    <th>City Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getAreas = getAllDataWithActiveRecent('grocery_lkp_areas'); $i=1;
                                while ($row = $getAreas->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <!-- <td>Area1234</td> -->
                                    <td><?php echo $row['area_name'] ?></td>
                                    <td><?php $getPincodes = getAllData('grocery_lkp_pincodes'); while($getPincodesData = $getPincodes->fetch_assoc()) { if($row['lkp_pincode_id'] == $getPincodesData['id']) { echo $getPincodesData['pincode']; } } ?></td>
                                    <td><?php $getCities = getAllData('grocery_lkp_cities'); while($getCitiesData = $getCities->fetch_assoc()) { if($row['lkp_city_id'] == $getCitiesData['id']) { echo $getCitiesData['city_name']; } } ?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_lkp_areas'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_lkp_areas'>In Active</span>" ;} ?></td>
                                    <td><span><a href="edit_lkp_areas.php?area_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a>  &nbsp;<!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "lkp_areas" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></span></td>
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
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
    <script>
        $(document).ready(function() {
        var max_fields_limit      = 10; //set limit for maximum input fields
        var x = 1; //initialize counter for text box
        $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
            e.preventDefault();
            if(x < max_fields_limit){ //check conditions
                x++; //counter increment
                $('.input_fields_container').append('<div><div class="row"><label class="col-sm-3 control-label" for="form-control-9">Area Name</label><div class="col-sm-6 col-md-4"><input type="text" name="area_name[]" class="form-control" id="user_input" placeholder="Enter Area Name" required></div><a href="#" class="remove_field btn btn-warning"><i class="zmdi zmdi-minus-circle zmdi-hc-fw"></i></a></div></div>'); //add input field
            }
        });  
        $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
  </body>
</html>