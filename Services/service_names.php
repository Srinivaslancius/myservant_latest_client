<?php
include "../admin_includes/config.php"; 

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql="SELECT id,group_service_name,related_tags FROM services_group_service_names WHERE related_tags LIKE '%{$query}%' ";
    $getCn = $conn->query($sql);
	$array = array();
    while ($row = $getCn->fetch_array()) {
        $array[] = array (
            'label' => $row['id'],
            'value' => $row['group_service_name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>