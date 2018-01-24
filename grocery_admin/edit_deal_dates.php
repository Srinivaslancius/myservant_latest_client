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
      <?php $cid = $_GET['cid']; 
      ?>
      <?php
        if(!empty($_POST['submit']) && !empty($_POST['submit']))  {

    //echo "<pre>";print_r($_POST); exit;
    
    $deal_start_date = $_POST['deal_start_date'];   
    

    $deal_end_date = $_POST['deal_end_date'];
    
    $sql="UPDATE grocery_products SET deal_start_date = '$deal_start_date', deal_end_date = '$deal_end_date' WHERE id = '$cid' ";
    if($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>window.location='manage_products.php?msg=success'</script>"; 
    }
    exit();
}
        ?>
        <?php
             $row = getIndividualDetails('grocery_products','id',$cid);

            if($row['deal_start_date']!='0000-00-00 00:00:00') {
            $deal_start_date = date('Y-m-d H:i:s', strtotime($row['deal_start_date']));
            } else {
            $deal_start_date = '';
            }
            
            if($row['deal_end_date']!='0000-00-00 00:00:00') {
            $deal_end_date = date('Y-m-d H:i:s', strtotime($row['deal_end_date']));
            } else {
            $deal_end_date = '';
            }

            ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Updates Date And Time</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div id="datetimepicker1" class="input-append date">
                            <div class="form-group">
                                <label for="form-control-5" class="col-sm-3 col-md-4 control-label">Deal Start Date</label>
                                <div class="col-sm-6 col-md-5">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" placeholder="Deal Start Date" name="deal_start_date" required="required" value="<?php echo $deal_start_date; ?>">
                                    <span class="add-on">
                                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                  </i>
                                </span>
                                </div>
                            </div>
                        </div>
                            <div id="datetimepicker2" class="input-append date">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Deal End Date</label>
                                <div class="col-sm-6 col-md-5">
                                    <input data-format="yyyy-MM-dd hh:mm:ss" type="text" placeholder="Deal Start Time" name="deal_end_date" required="required" value="<?php echo $deal_end_date; ?>">
                                    <span class="add-on">
                                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                  </i>
                                </span>
                                </div>
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

        <link href="css/datetime/datetime.css" rel="stylesheet">
       <link href="css/datetime/datetime2.css" rel="stylesheet">
 
    <?php include_once 'footer.php'; ?>

    <script type="text/javascript"
     src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    
    <script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({      
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $('#datetimepicker2').datetimepicker({      
    });
  });
</script>

  </body>
</html>