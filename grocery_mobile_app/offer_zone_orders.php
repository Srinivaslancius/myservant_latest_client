<?php 
error_reporting(1);
include "../admin_includes/config.php";
include "../admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) && !empty($_REQUEST['offerId']) ) {

		$user_id = $_REQUEST['userId'];
		$offer_id = $_REQUEST['offerId'];
		$getUserData = getIndividualDetails('users','id',$user_id);
		$offerZone = getIndividualDetails('grocery_offer_zone','id',$offer_id);
		$getSiteSettingsData1 = getIndividualDetails('grocery_site_settings','id','1');

		$user_first_name = $getUserData['user_full_name'];
		$user_last_name = $getUserData['user_full_name'];
		$user_email = $getUserData['user_email'];
		$user_phone = $getUserData['user_mobile'];
		$order_date = date("Y-m-d h:i:s");
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$contstr = "MYSER-GR";
		$order_id = $contstr.$random1.$random2;
		$offer_reward_points = $offerZone['offer_reward_points'];
		$offer_end_date = $offerZone['offer_end_date'];
		$offer_code = $offerZone['offer_code'];

		$getRewards1 = "SELECT * FROM grocery_reward_transactions WHERE user_id = '$user_id' ";
 		$getRewards = $conn->query($getRewards1);
 		while ($getRewards1 = $getRewards->fetch_assoc()) {
 			$credit_reward_points += $getRewards1['credit_reward_points'];
 			$debit_reward_points += $getRewards1['debit_reward_points'];
 		}
 		$totalRewards = $credit_reward_points - $debit_reward_points;

 		if($totalRewards >= $offerZone['offer_reward_points']) {

 			$orders = "INSERT INTO grocery_offer_zone_orders (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone`, `order_id`, `offer_id`, `offer_reward_points`, `offer_end_date`, `created_at`) VALUES ('$user_id','$user_first_name','$user_last_name','$user_email','$user_phone','$order_id','$offer_id','$offer_reward_points','$offer_end_date','$order_date')";
			$groceryOrders = $conn->query($orders);

			$transation_status = "Debited Reward Points to purchase coupon";
			$reward_points = "INSERT INTO grocery_reward_transactions (`user_id`, `offerzone_purchase_id`, `transation_status`, `debit_reward_points`, `created_at`) VALUES ('$user_id','$order_id','$transation_status','$offer_reward_points','$order_date')";
			$result = $conn->query($reward_points);

			if ($conn->query($orders) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Save Successfully";   
	            $response["order_id"] = $order_id;

	            //$dataem = $getUserData['user_email'];
				$to = $user_email;
				$from = $getSiteSettingsData1["orders_email"];
				$subject = "My Servent - Offer Coupon ";
				$message = '';
				$message .= '<body>
					<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
					<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
					 <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
					</header>
					<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
					  <h1 style="color:#fe6003">Greetings From Myservant</h1>
					  <p>Dear <span style="color:#fe6003;">'.$user_first_name.'</span>, Thank you for Purchasing Coupons.  myservant.com!</p>
						<p>Your Offer Coupon Code is: <span style="color:#fe6003;">'.$offer_code.'</span></p>
						<p>We hope you enjoy your stay at myservant.com, if you have any problems, questions, opinions, praise, comments, suggestions, please free to contact us at any time.</p>
						<p>Warm Regards,<br>The Myservant Team </p>
					</article>
					<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
					</div>

					</body>';

				//echo $message; die;
				//$sendMail = sendEmail($to,$subject,$message,$from);
				$name = "My Servant - Grocery";
				$mail = sendEmail($to,$subject,$message,$from,$name);

				//Sending SMS after Purchase coupon
				$message1 = urlencode('Thank you for purchasing offer coupon. Your Offer Coupon Code is '.$offer_code.''); // Message text required to deliver on mobile number
			    $sendSMS = sendMobileSMS($message1,$user_phone);

	        } else {
	            // fail query insert problem
	            $response["success"] = 1;
	            $response["message"] = "Oops! An error occurred.";                      
	        }
 		} else { 
 			$response["success"] = 4;
            $response["message"] = "To purchase this coupon minimum ".$offer_reward_points." reward points required.";
 		}
		 
	} else {

		$response["success"] = 2;
    	$response["message"] = "Required field(s) is missing";		
	}
} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";
}

echo json_encode($response);

?>