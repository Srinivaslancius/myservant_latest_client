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
        <?php $tid = $_GET['tid']; ?>
        <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 

            $booking_per_slot = $_REQUEST['booking_per_slot'];

              $sql = "UPDATE `grocery_manage_time_slots` SET booking_per_slot = '$booking_per_slot' WHERE id = '$tid' ";
              $result = $conn->query($sql);
              if( $result == 1){
                echo "<script type='text/javascript'>window.location='manage_time_slots.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='manage_time_slots.php?msg=fail'</script>";
            }
        }  
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Manage Time Slots</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getTimeslots = getIndividualDetails('grocery_manage_time_slots','id',$tid); ?>
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Start Time</label>
                                <div class="col-sm-6 col-md-4">
                                    <input readonly type='text' class="form-control" name="start_time" placeholder="Start Time" value="<?php echo $getTimeslots['start_time']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">End Time</label>
                                <div class="col-sm-6 col-md-4">
                                    <input readonly type='text' class="form-control" name="end_time" placeholder="End Time" value="<?php echo $getTimeslots['end_time']; ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Booking Per Slot</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Booking Per Slot" name="booking_per_slot" required="required" value="<?php echo $getTimeslots['booking_per_slot']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Slot Length (Mins)</label>
                                <div class="col-sm-6 col-md-4">
                                    <input readonly type="text" class="form-control valid_mobile_num" id="form-control-3" placeholder="Slot Length (Mins)" name="slot_length" required="required" value="<?php echo $getTimeslots['slot_length']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Booking Time Gap (Mins)</label>
                                <div class="col-sm-6 col-md-4">
                                    <input readonly type="text" class="form-control valid_mobile_num" id="form-control-3" placeholder="Booking Time Gap(Mins)" name="booking_time_gap" required="required" value="<?php echo $getTimeslots['booking_time_gap']; ?>">
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
        </div>
        

    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
  </body>
</html>