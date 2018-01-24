<?php
include_once 'meta.php';
//echo "<pre>"; print_r($_POST); die;
if(!empty($_POST['user_mobile']) && !empty($_POST['mobile_otp']))  {
	//echo "<pre>"; print_r($_POST); die;
	$mobile_otp = $_POST['mobile_otp'];
		
	$user_full_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_mobile = $_POST['user_mobile'];
	$user_password = $_POST['user_password'];	
	$lkp_status_id = 0; //0-active, 1- inactive
	$login_count = 1;
	$last_login_visit = date("Y-m-d h:i:s");
	$lkp_register_device_type_id=1; //1- web, 2- android, 3-ios
	$user_login_type = 1; //1-Normal, 2-Facebook,3-twitter
	$created_at = date("Y-m-d h:i:s");

	$sql="SELECT * FROM user_mobile_otp WHERE user_mobile='$user_mobile' AND mobile_otp='$mobile_otp' ";
	$getCn = $conn->query($sql);
	$getnoRows = $getCn->num_rows;
	if($getnoRows > 0) {
		$saveUser = saveUser($user_full_name, $user_email, $user_mobile, $user_password,$lkp_status_id,$login_count,$last_login_visit,$lkp_register_device_type_id,$user_login_type,'',$created_at);
		$getUserData = userLogin($user_email,$user_password);
		$getLoggedInDetails = $getUserData->fetch_assoc();
		$_SESSION['user_login_session_id'] =  $getLoggedInDetails['id'];
        $_SESSION['user_login_session_name'] = $getLoggedInDetails['user_full_name'];
        $_SESSION['user_login_session_email'] = $getLoggedInDetails['user_email'];
        $_SESSION['timestamp'] = time();

        $dataem = $getLoggedInDetails["user_email"];
		//$to = "srinivas@lanciussolutions.com";
		$to = $dataem;
		//$from = $getSiteSettingsData["email"];
		$subject = "Myservent - Services ";
		$message = "";
		$message .= "<style>
		        .body{
		    width:100% !important; 
		    margin:0 !important; 
		    padding:0 !important; 
		    -webkit-text-size-adjust:none;
		    -ms-text-size-adjust:none; 
		    background-color:#FFFFFF;
		    font-style:normal;
		    }
		    .header{
		    background-color:#c90000;
		    color:white;
		    width:100%;
		    }
		    .content{
		    background-color:#FBFCFC;
		    color:#17202A;
		    width:100%;
		    padding-top:15px;
		    padding-bottom;15px;
		    text-align:justify;
		    font-size:14px;
		    line-height:18px;
		    font-style:normal;
		    }
		    h3{
		    color: #c90000;}
		    .footer{
		    background-color:#c90000;
		    color:white;
		    width:100%;
		    padding-top:9px;
		    padding-bottom:5px;
		    }
		    .logo-responsive{
		    max-width: 100%;
		    height: auto !important;
		    }
		    @media screen and (min-width: 480px) {
		        .content{
		        width:50%;
		        }
		        .header{
		        width:50%;
		        }
		        .footer{
		        width:50%;
		        }
		        .logo-responsive{
		        max-width: 100%;
		        height: auto !important;
		        }
		    }
		    </style>";

		$message .= "<html><head><title>Myservent Services</title></head>
		<body>
		        <div class='container header'>
		            <div class='row'>
		                <div class='col-lg-2 col-md-2 col-sm-2'>
		                </div>
		                <div class='col-lg-8 col-md-8 col-sm-8'>
		                <center><h2>".$getSiteSettingsData['admin_title']."</h2></center>
		                </div>
		                <div class='col-lg-2 col-md-2 col-sm-2'>
		                    
		                </div>
		            </div>
		        </div>
		        <div class='container content'>
		            <h3>Hi, Welcome to MY SERVANT</h3>
		            <h4>Dear: ".$getLoggedInDetails["user_full_name"]."</h4>
		            <h4>Your Registration has been successfully completed. Please check your mail for confirmation.</h4>
		            <p>Your Email ID : ".$getLoggedInDetails["user_email"]."</p>
		            <p>Password : ".decryptPassword($getLoggedInDetails["user_password"])."</p>
		        </div>
		        <div class='container footer'>
		            <center>".$getSiteSettingsData['footer_text']."</center>
		        </div>
		    </body>
		</html>";

		//echo $message; die;
		//$sendMail = sendEmail($to,$subject,$message,$from);
		$name = "My Servant";
		$from = "info@myservant.com";
		$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
        $headers .= 'From: '.$name.'<'.$from.'>'. "\r\n";
        mail($to, $subject, $message, $headers);

		echo $getnoRows;
	} else {
		echo $getnoRows;
	}
}
?>