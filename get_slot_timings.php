<?php
include "admin_includes/config.php";
include "admin_includes/common_functions.php";
//echo "<pre>"; print_r($_POST); die;
if(isset($_POST['dateText']) ) { 

$getToday = date("m/d/Y");
if($getToday == $_POST['dateText']) {

    $getDuration = getIndividualDetails('grocery_manage_time_slots','lkp_status_id',0);
    $cur_time=date("Y-m-d H:i:00");
    $duration='+'.$getDuration['booking_time_gap'].' minutes';
    $getCurTime = date('H:i:00', strtotime($duration, strtotime($cur_time)));

    $query = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  AND start_time > '$getCurTime' ";
    $results = $conn->query($query);
    $gettotalSlt = $results->num_rows;

} else {

    $query ="SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0 ";
    $results = $conn->query($query);
}


?>   
<?php
    foreach($results as $getsots) {
?>
<?php if($getToday == $_POST['dateText']) { ?>
    <option value="<?php echo $getsots["total_slot_time"]; ?>">Today - <?php echo $getsots["total_slot_time"]; ?></option>
<?php } else { ?>
    <option value="<?php echo $getsots["total_slot_time"]; ?>"><?php echo $getsots["total_slot_time"]; ?></option>
<?php } ?>
<?php
    }
}
?>
