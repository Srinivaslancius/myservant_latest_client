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
    } else {
    //If success
      
    $id=1;
    $transaction_amount = $_POST['transaction_amount']; 
    $reward_points = $_POST['reward_points'];  
    $for_reward_points = $_POST['for_reward_points']; 
    $amount_credits = $_POST['amount_credits']; 
    $reward_status = $_POST['reward_status'];

    $sql = "UPDATE `grocery_reward_points` SET transaction_amount = '$transaction_amount', reward_points= '$reward_points', for_reward_points = '$for_reward_points', amount_credits='$amount_credits', reward_status = '$reward_status' WHERE id = '$id' ";
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
                    <h3 class="m-y-0 font_sz_view">Reward Points</h3>
                </div>
                <?php $getRewardPointsdata = getIndividualDetails('grocery_reward_points','id',1); ?>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                 <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Reward Points Status</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="reward_status" class="form-control product" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select Reward Point Type --</option>
                                        <option value="0" <?php if($getRewardPointsdata['reward_status'] == 0) { echo "Selected"; } ?> >Yes</option>
                                        <option value="1" <?php if($getRewardPointsdata['reward_status'] == 1) { echo "Selected"; } ?> >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Transcation Amount</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control valid_price_dec" id="form-control-3" placeholder="Enter Transcation Amount" name="transaction_amount" value="<?php echo $getRewardPointsdata['transaction_amount'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Reward Points</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control valid_mobile_num" id="form-control-3" placeholder="Enter Reward Points" name="reward_points" required value="<?php echo $getRewardPointsdata['reward_points'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">For Reward Points</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control valid_mobile_num" name="for_reward_points" id="form-control-3" placeholder="Enter For Reward Points" required value="<?php echo $getRewardPointsdata['for_reward_points'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Amount Credits</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control valid_price_dec" name="amount_credits" id="form-control-3" placeholder="Enter Amount Credits" required value="<?php echo $getRewardPointsdata['amount_credits'];?>">
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
  </body>
</html>