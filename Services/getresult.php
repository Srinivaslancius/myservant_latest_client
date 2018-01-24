<?php
error_reporting(1);
include "../admin_includes/config.php";

$perPage = 3;
$uid=$_SESSION['user_login_session_id'];
$sql = "SELECT * from services_orders WHERE user_id = '$uid' ORDER BY id DESC";
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage; 
$faq = $conn->query($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $faq->num_rows;
}
$pages  = ceil($_GET["rowcount"]/$perPage);
$output = '';
if(!empty($faq)) {
$output .= '<input type="hidden" class="pagenum" value="' . $page . '" /><input type="hidden" class="total-page" value="' . $pages . '" />';
while($orderData = $faq->fetch_assoc()) {
 $output .=  '<div class="panel panel-default">
                    <div class="panel-heading" style="border-bottom:0px">
                        <div class="row">
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>ORDER PLACED</b></p>
                                <p>'.$orderData['created_at']. '</p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>TOTAL</b></p>
                                <p>Rs.'.$orderData['order_total'].' </p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>SHIP TO</b></p>
                                <p>'.$orderData['first_name'].'<br>'.$orderData['address'].'</p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>ORDER ID:</b></p>
                                <p>'.$orderData['order_sub_id'].'</p><br>
                                <div class="row">
                                
                                <div class="col-sm-5">
                                <a href="view_orders.php?token='.$orderData['order_sub_id'].'" class="btn_1 outline" style="border-color:#f26226;padding:2px 10px;text-transform:capitalize">Details</a>
                                </div>
                                <div class="col-sm-5">
                                <a href="track_order_details.php?token='.$orderData['order_sub_id'].'" class="btn_1 outline" style="border-color:#f26226;padding:2px 10px;text-transform:capitalize">Track</a>
                                </div>
                                <div class="col-sm-2">
                                </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>                            
                </div>';
}
}
print $output;
?>
