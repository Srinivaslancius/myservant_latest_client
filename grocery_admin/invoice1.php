<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>MYSERVANT</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
	<style>
	.site-footer{
		margin:0 auto;
	}
	.layout{
		padding-top:0px;
	}
	.site-content {
    padding: 60px 60px 65px 60px;
}
	</style>
  </head>

<?php
error_reporting(0);
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
?>

  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
 
  <?php $getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);?>
    <div class="site-main">     
     
      <div class="site-content" style="margin: 0 auto">
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
            
           <img src="<?php echo $base_url . 'grocery_admin/uploads/logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" >
			 <center><h3 class="m-y-0">User Wallet Transcaction</h3></center>
          </div>
          <div class="panel-body">
            <div class="row m-b-30">
              <div class="col-sm-6">                
                
              </div>
              <div class="col-sm-6">                
                
              </div>
            </div>
            <table class="table table-bordered m-b-30">
              <thead>
                <tr>
                  <th>
                    S.No
                  </th>
                  <th>
                    Customer Name
                  </th>
                  <th>
                    Transaction Id
                  </th>
                  <th>
                    Credit Amount
                  </th>
                  <th>
                    Debit Amount
                  </th>                
                  <th>
                    Payment Status
                  </th>
                </tr>
              </thead>
<?php 
$id = $_GET['id'];

$getUserTransactionData = "SELECT * FROM user_wallet_transactions WHERE id='$id'";
$getUserTransaction = $conn->query($getUserTransactionData);
while($getTransaction = $getUserTransaction->fetch_assoc()) { 
$getUsersData = getIndividualDetails('users','id',$getTransaction['user_id']);
$PaymentStatus = getIndividualDetails('lkp_payment_status','id',$getTransaction['lkp_payment_status_id']);
?>
              <tbody>
              	
                <tr>
                  <td><?php echo 1; ?></td>
                  <td><?php echo $getUsersData['user_full_name'] ?></td>     
                  <td><?php echo $getTransaction['transaction_id'] ?></td>
                  <td><?php echo $getTransaction['credit_amnt'] ?></td>
                  <td><?php echo $getTransaction['debit_amnt'] ?></td>
                  <td><?php echo $PaymentStatus['payment_status'] ?></td>
                </tr>  
                <?php $i++; } ?>              
              </tbody>
            </table>
          
          </div>
          <div class="panel-footer text-right">
            <button type="button" class="btn btn-primary btn-labeled" onclick="myFunction()">Print
              <span class="btn-label btn-label-right p-x-10">
                <i class="zmdi zmdi-print"></i>
              </span>
            </button>
            
          </div>
        </div>
      </div>
      <?php include_once 'footer.php'; ?>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
  </body>
  	<script>
	function myFunction() {
	    window.print();
	}
	</script>

</html>