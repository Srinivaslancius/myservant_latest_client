<?php ob_start(); ?>
<?php if(isset($_POST['search'])) {

  $cat_id = $_POST['id'];
  if($_POST['id'] == '0' && $_POST['service_name'] == '') {
    //header("Location:services.php");
    echo '<script>window.location.replace("services.php")</script>';
   
  } elseif(!empty($_POST['id'])) {
    $cat_id = $_POST['id'];
    //header("Location:sub_categories.php?cat_id=".encryptPassword($cat_id).""); 
    echo '<script>window.location.replace("sub_categories.php?cat_id='.encryptPassword($cat_id).'")</script>';
  } elseif(!empty($_POST['service_name'])) {
    $service_name = $_POST['service_name'];
  $getGroupServiceNames = getAllDataWhereWithActive('services_group_service_names','related_tags',$service_name);
  $getGroupServiceNamesData = $getGroupServiceNames->fetch_assoc();
    //header("Location:list.php?sub_cat_id=".encryptPassword($getGroupServiceNamesData['services_sub_category_id'])."");
    echo '<script>window.location.replace("list.php?sub_cat_id='.encryptPassword($getGroupServiceNamesData['services_sub_category_id']).'")</script>';
  }
}
?>
<div id="search_bar_container">
    <div class="container">
        <div class="row">
    <form method="post" action="">
        <div class="search_bar">
            <div class="col-md-3 col-sm-3 col-xs-5 padd0">
        <span class="nav-facade-active" id="nav-search-in">
            <span id="nav-search-in-content">Services Categories</span>
            <span class="nav-down-arrow nav-sprite"></span>
            <select name="id" class="searchSelect" id="searchDropdownBox">
            <?php $getCategoriesData = getAllDataWhere('services_category','lkp_status_id','0'); ?>
            <option value="0">Service Category</option>
            <?php while($row = $getCategoriesData->fetch_assoc()) {  ?>
              <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
           <?php } ?>                                    
            </select>
            </span>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-7 padd0">
            <div class="nav-searchfield-outer">
            <input type="text" autocomplete="off" name="service_name" class="service_name" placeholder=" Search your related service" id="twotabsearchtextbox" style="width:700px; line-height:30px; border:1px solid white">
            </div>
           <div class="nav-submit-button">
                <button type="submit" class="btn btn-default bttn_st" name="search" style="height:40px;border-radius: 1px;border-color:#fe6003;color:black;padding:2px 20px">Submit</button>
           </div>
            </div>
        </div>
            
    </form>
        </div>
    </div>
</div>

<script>
//Search bar
$(function () {
$("#searchDropdownBox").change(function(){
  var Search_Str = $(this).find('option:selected').text();  
    //var Search_Str = $(this).val();
    //replace search str in span value
    $("#nav-search-in-content").text(Search_Str);
  });
});
</script>

<!-- Search with Auto Complete -->
<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
<style>
  .tt-dropdown-menu {
      width: 700px;
      margin-top: 5px;
      padding: 8px 12px;
      background-color: #fff;
      font-size: 12px;
      color: #888;
      background-color: #FFFF;
    line-height:10px !important;
  }
</style>
<script>
    $(document).ready(function() {
        $('input.service_name').typeahead({
            name: 'service_name',
            remote: 'service_names.php?query=%QUERY'
        });
    })
</script>