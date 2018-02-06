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
            $start_time = $_REQUEST['start_time'];            
            $end_time = $_REQUEST['end_time'];            
            $slot_length = $getSiteSettingsData['slot_length'];
            $lkp_status_id = $_REQUEST['lkp_status_id'];
            $booking_per_slot = $_REQUEST['booking_per_slot'];

            // Create $slots array of the booking times
            for($i = strtotime($start_time); $i<= strtotime($end_time); $i = $i + $slot_length * 60) {
                $slots[] = date("g:i A", $i);  
            }   

            // Loop through the $slots array and create the booking table
            $last_key = end(array_keys($slots));
            foreach($slots as $i => $start) {
                // Calculate finish time
                if ($i == $last_key) {
                    // last element
                } else {
                    // not last element
                    $finish_time = strtotime($start) + $slot_length * 60; 
                    $total_slot_time = $start . " - " . date("g:i A", $finish_time);

                    $start_time1 = $start;
                    $end_time1 = date("g:i A", $finish_time);

                    $sql = "INSERT INTO grocery_manage_time_slots (`start_time`, `end_time`, `lkp_status_id`, `total_slot_time`, `booking_per_slot`) VALUES ('$start_time1', '$end_time1', '$lkp_status_id', '$total_slot_time', '$booking_per_slot')";
                    $result = $conn->query($sql);
                }        
            } // Close foreach      
           
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
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Start Time</label>
                                <div class="col-sm-6 col-md-4">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" name="start_time" placeholder="Start Time"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">End Time</label>
                                <div class="col-sm-6 col-md-4">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" name="end_time" placeholder="End Time" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Booking Per Slot</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Booking Per Slot" name="booking_per_slot" required="required">
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
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Manage Time Slots</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Start Time</th>
                                    <th>End Time</th> -->                                                 
                                    <th>Total Slots</th>
                                    <th>Booking Per Slot</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 //$getManageTimeSlots = getAllDataWithActiveRecent('grocery_manage_time_slots'); $i=1; 

                                $getManageTimeSlots1= "SELECT * FROM grocery_manage_time_slots ORDER BY id ASC";
                                $getManageTimeSlots = $conn->query($getManageTimeSlots1);
                                $i=1;
                                ?>
                                <?php while ($row = $getManageTimeSlots->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td><?php echo $row['start_time']; ?></td>
                                    <td><?php echo $row['end_time']; ?></td> -->
                                    <td><?php echo $row['total_slot_time']; ?></td>
                                    <td><?php echo $row['booking_per_slot']; ?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_manage_time_slots'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_manage_time_slots'>In Active</span>" ;} ?></td>
                                    <td></td>
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

    <!-- Time picker scripts for time slots -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1,#datetimepicker2,#datetimepicker3,#datetimepicker4').datetimepicker({
                format: 'HH:mm',
                stepping: 30
            });
        });
    </script>
    <!-- End Time picker scripts for time slots -->

  </body>
</html>