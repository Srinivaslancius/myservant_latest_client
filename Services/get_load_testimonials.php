<?php
include "../admin_includes/config.php";
$perPage = 3;

$getTestimonials = "SELECT * from services_testimonials WHERE lkp_status_id = 0";
$page = 1;
if(!empty($_GET["page"])) {	
	$page = $_GET["page"];
}

$start = ($page-1)*$perPage;
if($start < 0) $start = 0;

$query =  $getTestimonials . " limit " . $start . "," . $perPage; 
$getAllTestimonials = $conn->query($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $getAllTestimonials->num_rows;
}
$pages  = ceil($_GET["rowcount"]/$perPage);
$output = '';
if(!empty($getAllTestimonials)) {
$output .= '<input type="hidden" class="pagenum" value="' . $page . '" /><input type="hidden" class="total-page" value="' . $pages . '" />';
while($getTestimonials = $getAllTestimonials->fetch_assoc()) {
 $output .=  '<div class="strip_all_tour_list wow fadeIn"  data-wow-delay="0.1s">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3">
								<div class="img_list">
									<a href="#">
									<img src="'.$base_url . 'uploads/services_testimonials_images/'.$getTestimonials['image'].'" alt="Image" style="width:800px; height:533px;">
									</a>
								</div>
							</div>
							<div class="clearfix visible-xs-block"></div>
							<div class="col-lg-9 col-md-9 col-sm-9">
								<div class="tour_list_desc"  style="padding-top:20px">									
									<h3><strong>'. $getTestimonials['title']. '</strong></h3>
									<p>'. $getTestimonials['description'] .'</p>									
								</div>
							</div>
							
						</div>
					</div>';
}
}
print $output;
?>
