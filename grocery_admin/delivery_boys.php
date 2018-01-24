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
            $deliveryboy_name = $_REQUEST['deliveryboy_name'];
            $deliveryboy_email = $_REQUEST['deliveryboy_email'];
            $deliveryboy_mobile = $_REQUEST['deliveryboy_mobile'];            
            $image = $_REQUEST['image'];
            $lkp_status_id = $_REQUEST['lkp_status_id'];

            if($_FILES["image"]["name"]!='') {

                $image = uniqid().$_FILES["image"]["name"];
                $target_dir = "uploads/grocery_deliveryboys/";
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $sql = "INSERT INTO grocery_delivery_boys (`deliveryboy_name`,`deliveryboy_mobile`,`deliveryboy_email`,`identity_proof_image`, `lkp_status_id`) VALUES ('$deliveryboy_name', '$deliveryboy_mobile', '$deliveryboy_email','$image','$lkp_status_id')";
            } 
            
            $result = $conn->query($sql);
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='delivery_boys.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='delivery_boys.php?msg=fail'</script>";
            }
        }
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Delivery Boys</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Name</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="deliveryboy_name" class="form-control" id="form-control-3" placeholder="Enter Name"  required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Email</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="email"  name="deliveryboy_email" class="form-control" id="user_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" placeholder="Enter Email"  required="required" onkeyup="checkUserAvailTest()">
                                    <span id="input_status" style="color: red;"></span>
                                    <div class="help-block with-errors"></div>
                                    <input type="hidden" id="table_name" value="grocery_delivery_boys">
                                    <input type="hidden" id="column_name" value="deliveryboy_email"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Mobile</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="deliveryboy_mobile" class="form-control" id="form-control-3" placeholder="Enter Mobile"  required="required" onkeypress="return isNumberKey(event)" maxlength="10" pattern="[0-9]{10}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="image" required="required" accept="image/*">
                                    </label>
                                </div>
                            </div>
                             
                            <?php $getStatus = getAllData('lkp_status');?>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="lkp_status_id" name="lkp_status_id" class="form-control" required>
                                        <option value="">-- Select Status --</option>
                                         <?php while($row = $getStatus->fetch_assoc()) {  ?>
                                              <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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

             <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Delivery Boys</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Identity Proof</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getEmployees = getAllDataWithActiveRecent('grocery_delivery_boys'); $i=1; ?>
                                <?php while ($row = $getEmployees->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['deliveryboy_name']; ?></td>
                                    <td><?php echo $row['deliveryboy_email']; ?></td>
                                    <td><?php echo $row['deliveryboy_mobile']; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_deliveryboys/'.$row['identity_proof_image']; ?>"  id="output" height="60" width="60"/></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_delivery_boys'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_delivery_boys'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_deliveryboys.php?cid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
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
  </body>
</html>