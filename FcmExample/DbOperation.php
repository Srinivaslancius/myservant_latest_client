<?php

class DbOperation
{
    //Database connection link
    private $con;

    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';

        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }

    //storing token in database 
    public function registerDevice($email,$token){
        if(!$this->isEmailExist($email)){
            $stmt = $this->con->prepare("INSERT INTO users (user_email, mobile_token) VALUES (?,?) ");
            $stmt->bind_param("ss",$email,$token);
            if($stmt->execute())
                return 0; //return 0 means success
            return 1; //return 1 means failure
        }else{
            return 2; //returning 2 means email already exist
        }
    }

    
    //storing token in database 
    public function savePushNotifications($services,$message,$dat){
    //echo $dat; die;   
       $stmt = $this->con->prepare("INSERT INTO mobile_push_notifications(service_name, message, created_at) VALUES (?,?,?) ");
       $stmt->bind_param("sss",$services,$message,$dat);
       if($stmt->execute())
                return 0; //return 0 means success
            return 1; //return 1 means failure
    }

    //the method will check if email already exist 
    private function isEmailexist($email){
        $stmt = $this->con->prepare("SELECT id FROM users WHERE user_email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    //getting all tokens to send push to all devices
    public function getAllTokens(){
        //$stmt = $this->con->prepare("SELECT token FROM devices");
        //$stmt->execute(); 
        //$result = $stmt->get_result();
        $sql = "SELECT mobile_token FROM users";
        $result = $this->con->query($sql);
        $tokens = array(); 
        while($token = $result->fetch_assoc()){
            array_push($tokens, $token['mobile_token']);
        }
        //echo "<pre"; print_r($tokens); die;
        return $tokens; 
    }

    //getting a specified token to send push to selected device
    public function getTokenByEmail($email){
        $stmt = $this->con->prepare("SELECT mobile_token FROM users WHERE user_email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_assoc();
        return array($result['token']);        
    }

    //getting all the registered devices from database 
    public function getAllDevices(){
        //$stmt = $this->con->prepare("SELECT * FROM devices");
        //$stmt->execute();
        //$result = $stmt->get_result();
        $sql = "SELECT * FROM users";
        $result = $this->con->query($sql);		
        //echo "<pre>"; print_r($result); die;
        return $result; 
    }
}