<?php
include "admin_includes/config.php";
//echo "<pre>"; print_r($_POST); die;
if(isset($_POST['dateText']) ) { 

$query ="SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0 ";
$results = $conn->query($query);
?>   
<?php
    foreach($results as $getsots) {
?>
    <option value="<?php echo $getsots["total_slot_time"]; ?>"><?php echo $getsots["total_slot_time"]; ?></option>
<?php
    }
}
?>