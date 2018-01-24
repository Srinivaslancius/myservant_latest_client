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
          //If fail
          echo "fail";
        }else  {
          //If success
          $tag_name = $_POST['tag_name'];
          foreach($tag_name as $key=>$value){
            if(!empty($value)) {
              $tag_name = $_REQUEST['tag_name'][$key];    
              $sql = "INSERT INTO grocery_tags (`tag_name`) VALUES ('$tag_name')";
              $result = $conn->query($sql);
            }
          }
          if( $result == 1){
            echo "<script type='text/javascript'>window.location='grocery_tags.php?msg=success'</script>";
          } else {
            echo "<script type='text/javascript'>window.location='grocery_tags.php?msg=fail'</script>";
          }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Tags</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="input_fields_container">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-control-9">Tag</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="tag_name[]" class="form-control" id="user_input" placeholder="Enter Tag" required onkeyup="checkUserAvailTest()">
                                    <span id="input_status" style="color: red;"></span>
                                    <div class="help-block with-errors"></div>
                                    <input type="hidden" id="table_name" value="grocery_tags">
                                    <input type="hidden" id="column_name" value="tag_name">
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
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Tags</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Brand Id</th> -->
                                    <th>Tag Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getTags = getAllDataWithActiveRecent('grocery_tags'); $i=1; ?>
                                <?php while ($row = $getTags->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td>Brnd345</td> -->
                                    <td><?php echo $row['tag_name']; ?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_tags'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_tags'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_grocery_tags.php?tag_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "grocery_brands" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
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
    <script>
        $(document).ready(function() {
        var max_fields_limit      = 10; //set limit for maximum input fields
        var x = 1; //initialize counter for text box
        $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
            e.preventDefault();
            if(x < max_fields_limit){ //check conditions
                x++; //counter increment
                $('.input_fields_container').append('<div><div class="form-group"><label class="col-sm-3 control-label" for="form-control-9">Tag</label><div class="col-sm-6 col-md-4"><input type="text" name="tag_name[]" class="form-control" id="user_input" placeholder="Enter Tag" required></div><a href="#" class="remove_field btn btn-warning"style="margin-left:15px"><i class="zmdi zmdi-minus-circle zmdi-hc-fw"></i></a></div></div>'); //add input field
            }
        });  
        $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
  </body>
</html>