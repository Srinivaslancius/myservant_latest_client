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
        <?php $cid = $_GET['id']; ?>
        <?php
            if(!empty($_POST['date']) && !empty($_POST['date']))  {
            $deal_start_date = $_POST['deal_start_date']; 
            $deal_date = date('Y-m-d', strtotime($deal_start_date)); 
            $dealDate="UPDATE grocery_products SET deal_start_date = '$deal_date' WHERE id = '$cid' ";
            if($conn->query($dealDate) === TRUE) {
            echo "<script type='text/javascript'>window.location='manage_products.php?msg=success'</script>"; 
            }
            exit();
            }
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Hot Deal Date</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php 
                            $getDealDate ="SELECT * FROM grocery_products WHERE id='$cid'";
                            $getDealDate1 = $conn->query($getDealDate);
                            $row = $getDealDate1->fetch_assoc();
                        ?>
                        <?php
                        $todayDealDate = getIndividualDetails('grocery_products','id',$row['id']);
                        if($row['deal_start_date']!='0000-00-00' && $row['deal_start_date']!='') {
                        $deal_start_date1 = date('Y-m-d', strtotime($todayDealDate['deal_start_date']));
                        } else {
                        $deal_start_date1 = '';
                        }
                        ?>
                                    <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                                        <div class="form-group">
                                        <label for="form-control-5" class="col-sm-3 col-md-4 control-label">Deal Start Date</label>
                                        <div class="col-sm-6 col-md-5">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input class="date-pick" data-format="yyyy-MM-dd" type="text" placeholder="Deal Start Date" name="deal_start_date" required="required" value="<?php echo $deal_start_date1; ?>">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                        <button type="submit" value="date" name="date" class="btn btn-primary">Submit</button>
                                        </div>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include_once 'footer.php'; ?>
        <script src="js/dashboard-3.min.js"></script>
        <script src="js/tables-datatables.min.js"></script>
        <script type="text/javascript">
      $('input.date-pick').datepicker({minDate: 0, maxDate: "+2M"});
    </script>

  </body>
</html>