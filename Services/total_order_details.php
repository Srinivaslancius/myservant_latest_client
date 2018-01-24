<?php
include "../admin_includes/config.php";
$uid=$_POST['user_id'];
$sql = "SELECT * from services_orders WHERE user_id = '$uid' ORDER BY id DESC";
$getOrders = $conn->query($sql);
while($orderData = $getOrders->fetch_assoc()) {
 $output = '';
 $output .=  '<div class="panel panel-default">
                    <div class="panel-heading" style="border-bottom:0px">
                        <div class="row">
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>ORDER PLACED</b></p>
                                <p>'.$orderData['created_at']. '</p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>Order Price</b></p>
                                <p>Rs.'.$orderData['order_price'].' </p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>SHIP TO</b></p>
                                <p>'.$orderData['first_name'].'<br>'.$orderData['address'].'</p>
                            </div>
                            <div class="col-sm-3">
                                <p style="color:#f26226"><b>ORDER ID:</b></p>
                                <p>'.$orderData['order_sub_id'].'</p><br>
                                <div class="row">
                                
                                <div class="col-sm-5 col-xs-5">
                                <a href="view_orders.php?token='.$orderData['order_sub_id'].'" class="btn_1 outline" style="border-color:#f26226;padding:2px 10px;text-transform:capitalize">Details</a>
                                </div>
                                <div class="col-sm-5 col-xs-5">
                                <a href="track_order_details.php?token='.$orderData['order_sub_id'].'" class="btn_1 outline" style="border-color:#f26226;padding:2px 10px;text-transform:capitalize">Track</a>
                                </div>
                                <div class="col-sm-2 col-xs-2">
                                </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>                            
                </div>';

print $output;
}
?>
