<?php 
error_reporting(0);
include "../../admin_includes/config.php";
include "../../admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['userEmail']) && !empty($_REQUEST['userEmail']) ) {

		$sql="SELECT * FROM users WHERE user_email='".$_REQUEST['userEmail']."' AND lkp_status_id=0 ";
		$getCn = $conn->query($sql);
		$getCnt = $getCn->num_rows;
		$getUserForgotPassword = $getCn->fetch_assoc();

		$getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
		$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc();

		if($getCnt > 0) {

			$user_password = encryptPassword($getUserForgotPassword['user_password']);
			$to = $_REQUEST['userEmail'];
            $subject =  "Myservant - User Forgot Password";
            $message = '';
            $message .= '<body>
			<div class="container" style=" width:50%;border: 5px solid #fe6003;margin:0 auto">
			<header style="padding:0.8em;color: white;background-color: #fe6003;clear: left;text-align: center;">
			 <center><img src='.$base_url . "grocery_admin/uploads/logo/".$getSiteSettingsData1["logo"].' class="logo-responsive"></center>
			</header>
			<article style=" border-left: 1px solid gray;overflow: hidden;text-align:justify; word-spacing:0.1px;line-height:25px;padding:15px">
			  <h1 style="color:#fe6003">Your Password</h1>
			  <p>Dear <span style="color:#fe6003;">'.$getUserForgotPassword["user_full_name"].'</span>.</p>
			 
			 <p>Your Password : '.$user_password.'  </p>
			<footer style="padding: 1em;color: white;background-color: #fe6003;clear: left;text-align: center;">'.$getSiteSettingsData1['footer_text'].'</footer>
			</div>

			</body>';
			
			//echo $message; die;
			$name = "My Servant - Grocery";
			$from = $getSiteSettingsData1["forgot_password_email"];
			$resultEmail = sendEmail($to,$subject,$message,$from,$name);

			$response["success"] = 0;
			$response["message"] = "Password sent to your email";

		} else {
			$response["success"] = 1;
			$response["message"] = "Please enter valid Email.";

		}

	} else {
		$response["success"] = 2;
		$response["message"] = "Required Fields Missings!";

	}

} else {
	$response["success"] = 3;
	$response["message"] = "Invalid request";

}
echo json_encode($response);

?>