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
      <!-- <?php  
        if (!isset($_POST['submit']))  {
          //If fail
          echo "fail";
        }else  {
          //If success
          
          $fileToUpload = $_FILES["fileToUpload"]["name"];
          $fileToUpload1 = $_FILES["fileToUpload1"]["name"];
          $fileToUpload2 = $_FILES["fileToUpload2"]["name"];
          $fileToUpload3 = $_FILES["fileToUpload3"]["name"];
          $fileToUpload4 = $_FILES["fileToUpload4"]["name"];
          $fileToUpload5 = $_FILES["fileToUpload5"]["name"];
          if($fileToUpload!='' && $fileToUpload1!='' && $fileToUpload2!='' && $fileToUpload3!='' && $fileToUpload4!='' && $fileToUpload5!='') {
            $grocery_app_image = uniqid().$_FILES["fileToUpload"]["name"];
            $target_dir = "uploads/other_services_images/";
            $target_file = $target_dir . basename($grocery_app_image);

            $grocery_web_image = uniqid().$_FILES["fileToUpload1"]["name"];
            $target_dir1 = "uploads/other_services_images/";
            $target_file1 = $target_dir1 . basename($grocery_web_image);

            $food_app_image = uniqid().$_FILES["fileToUpload2"]["name"];
            $target_dir2 = "uploads/other_services_images/";
            $target_file2 = $target_dir2 . basename($food_app_image);

            $food_web_image = uniqid().$_FILES["fileToUpload3"]["name"];
            $target_dir3 = "uploads/other_services_images/";
            $target_file3 = $target_dir2 . basename($food_web_image);

            $services_app_image = uniqid().$_FILES["fileToUpload4"]["name"];
            $target_dir4 = "uploads/other_services_images/";
            $target_file4 = $target_dir4 . basename($services_app_image);

            $services_web_image = uniqid().$_FILES["fileToUpload5"]["name"];
            $target_dir5 = "uploads/other_services_images/";
            $target_file5 = $target_dir5 . basename($services_web_image);

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1);
                move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2);
                move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file3);
                move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_file4);
                move_uploaded_file($_FILES["fileToUpload5"]["tmp_name"], $target_file5);
                $sql = "INSERT INTO myservant_other_services (`grocery_app_image`,`grocery_web_image`,`food_app_image`,`food_web_image`,`services_app_image`,`services_web_image`) VALUES ('$grocery_app_image','$grocery_web_image', '$food_app_image', '$food_web_image', '$services_app_image', '$services_web_image')"; 
                if($conn->query($sql) === TRUE){
                   echo "<script type='text/javascript'>window.location='other_services.php?msg=success'</script>";
                } else {
                   echo "<script type='text/javascript'>window.location='other_services.php?msg=fail'</script>";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
          }
        }
        ?> -->
        <div class="site-content">
            <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Other Services</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" autocomplete="off">
                            
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Grocery App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload" multiple="multiple" accept="image/*" id="fileToUpload" onchange="loadFile(event)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Grocery Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output1" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload1" multiple="multiple" accept="image/*" id="fileToUpload" onchange="loadFile1(event)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Food App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output2" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload2" multiple="multiple" accept="image/*" id="fileToUpload2" onchange="loadFile2(event)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Food Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output3" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload3" multiple="multiple" accept="image/*" id="fileToUpload3" onchange="loadFile3(event)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Services App Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output4" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload4" multiple="multiple" accept="image/*" id="fileToUpload4" onchange="loadFile4(event)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Services Web Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <img id="output5" height="100" width="100"/>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="fileToUpload5" multiple="multiple" accept="image/*" id="fileToUpload5" onchange="loadFile5(event)" required>
                                    </label>
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
            </div> -->
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Other Services</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Grocery App Image</th>
                                    <th>Grocery Web Image</th>
                                    <th>Food App Image</th>
                                    <th>Food Web Image</th>
                                    <th>Services App Image</th>
                                    <th>Services Web Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getOtherServicesData = getAllDataWithActiveRecent('myservant_other_services'); $i=1; ?>
                                <?php while ($row = $getOtherServicesData->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['grocery_app_image'] ?>" width="100" height="100"></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['grocery_web_image'] ?>" width="100" height="100"></td>

                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['food_app_image'] ?>" width="100" height="100"></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['food_web_image'] ?>" width="100" height="100"></td>

                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['services_app_image'] ?>" width="100" height="100"></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/other_services_images/'.$row['services_web_image'] ?>" width="100" height="100"></td>

                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='myservant_other_services'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='myservant_other_services'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_other_services.php?brand_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "grocery_brands" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
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