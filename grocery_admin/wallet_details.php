<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from big-bang-studio.com/cosmos/pages-invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2017 10:14:32 GMT -->
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
  </head>

<?php
error_reporting(0);
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');
?>

  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
  <?php $getSiteSettingsData = getIndividualDetails('grocery_site_settings','id',1);?>
    <div class="site-main">     
     
      <div class="site-content">
        <div class="panel panel-default m-b-0">
          <div class="panel-heading">
            <h3 class="m-y-0">User Wallet Transcaction</h3>
            <center><img src="<?php echo $base_url . 'grocery_admin/uploads/logo/'.$getSiteSettingsData['logo'] ?>" class="logo-responsive" ></center>
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
                    Comments
                  </th>               
                  <th>
                    Payment Status
                  </th>
                  <th>
                    Credit Amount
                  </th>
                  <th>
                    Debit Amount
                  </th>
                </tr>
              </thead>
<?php 
$user_id = $_GET['user_id'];
$i=1;
$getUserTransactionData = "SELECT * FROM user_wallet_transactions WHERE user_id='$user_id' AND lkp_payment_status_id=1 ";
$getUserTransaction = $conn->query($getUserTransactionData);
if($getUserTransaction->num_rows > 0) { 
while($getTransaction = $getUserTransaction->fetch_assoc()) { 
$getUsersData = getIndividualDetails('users','id',$getTransaction['user_id']);
$PaymentStatus = getIndividualDetails('lkp_payment_status','id',$getTransaction['lkp_payment_status_id']);
?>
              <tbody>
              	
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $getUsersData['user_full_name'] ?></td>     
                  <td><?php echo $getTransaction['transaction_id'] ?></td>
                  <td><?php echo $getTransaction['description'] ?></td>
                  <td><?php echo $PaymentStatus['payment_status'] ?></td>
                  <td><?php echo $getTransaction['credit_amnt'] ?></td>
                  <td><?php echo $getTransaction['debit_amnt'] ?></td>
                  <?php $credit_amount += $getTransaction['credit_amnt'];
                      $debit_amount += $getTransaction['debit_amnt'];
                       ?>
                </tr>
                <?php   $i++; } ?>
                <tr>
                  <td colspan="5">
                  <td>
                    
                         Total Credit Amount: <?php echo $credit_amount ?>
                
                  </td>
                  <td>
                    
                        Total Debit Amount:  <?php echo $debit_amount ?>
                
                  </td>
                </tr>
                 <tr>
                  <td colspan="5">
                  <td>
                    
                         <b>Grand Total:</b>
                
                  </td>
                  <td>
                    <b><?php echo ($credit_amount - $debit_amount); ?></b>
                      
                
                  </td>
                </tr>
                  <!--<td>
                    <?php echo $credit_amount;?>
                        <br> <?php echo $debit_amount;?>
                        <br>
                      <strong><?php echo $total_amount;?></strong>
                  </td>-->
                </tr>
                <?php  } else { ?>
                  <tr><td colspan="6" style="text-align:center"><h3>No Transactions Found</h3></td></tr>
               <?php }?>              
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