    <?php include_once './meta_fav.php';?>
    
   
<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){

//include database configuration file


//count all rows except already displayed
$queryAll = "SELECT COUNT(*) as num_rows FROM food_vendors WHERE id = '" . $_POST["id"] . "' ORDER BY id DESC";

$getSearchResults = $conn->query($queryAll);
$row = $getSearchResults->fetch_assoc();

$allRows = $row['num_rows'];

$showLimit = 5;

//get rows query
$query = "SELECT * FROM food_vendors WHERE id = '" . $_POST["id"] . "' ORDER BY id DESC  ";
$getSearchResults1 = $conn->query($query);

//number of rows
?>


        
                  
                      <?php 
                      if($getSearchResults1->num_rows > 0) {
                        	while($row = $getSearchResults1->fetch_assoc()){ 
                      ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="strip_list wow fadeIn" data-wow-delay="0.1s">
                                    <div class="row">
                                            <div class="col-md-8 col-sm-9">
                                                    <div class="desc">
                                                            <div class="thumb_strip">
                                                                <a href="#"><img src="<?php echo $base_url . 'uploads/food_restaurants_images/'.$row['logo'] ?>" alt=""></a>
                                                            </div>
                                                            
                                                            <h4><?php echo $row['restaurant_name']; ?></h4>
                                                            <div class="type">
                                                                <?php echo $row['description']; ?>
                                                            </div>
                                                            
                                                            
                                                            <div class="rating">
                                                                    <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i> (<small><a href="#0">98 reviews</a></small>)
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-4 col-sm-3">
                                                    <div class="go_to">
                                                            <div>
                                                                <a href="view_rest_menu.php?key=<?php echo $getResults['id'];?>" class="btn_1">View Menu</a>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div><!-- End row-->
                            </div><!-- End strip_list-->
                        </div>

                        <?php } ?>
            			
