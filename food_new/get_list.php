<?php
error_reporting(1);
include "../admin_includes/config.php";

$perPage = 3;
echo $sql = "SELECT * from food_vendors WHERE ORDER BY id DESC"; die;
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
 $output .=  '<div class="strip_list wow fadeIn" data-wow-delay="0.1s">
        <div class="ribbon_1">
                Popular
        </div>
        <div class="row">
                <div class="col-md-8 col-sm-9">
                        <div class="desc">
                                <div class="thumb_strip">
                                        <a href="#"><img src="img/thumb_restaurant.jpg" alt=""></a>
                                </div>
                                
                                <h4>Taco Mexican</h4>
                                <div class="type">
                                        Mexican / American
                                </div>
                                
                                
                                <div class="rating">
                                        <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                                </div>
                        </div>
                </div>
                <div class="col-md-4 col-sm-3">
                        <div class="go_to">
                                <div>
                                    <a href="menu.php" class="btn_1">View Menu</a>
                                </div>
                        </div>
                </div>
        </div>
</div>';
}
}
print $output;
?>
