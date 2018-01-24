<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['pid'];
if (!isset($_POST['submit']))  {
            echo "";
} else  {
    
    //Save data into database
    $restaurant_id = $_POST['restaurant_id'];
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $item_type = $_POST['item_type'];
    $specifications = $_POST['specifications'];
    //$availability_id = $_POST['availability_id'];
    $lkp_status_id = $_POST['lkp_status_id'];
    $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
    //save product images into product_images table    
    if($_FILES["fileToUpload"]["name"]!='') {
        $fileToUpload = uniqid().$_FILES["fileToUpload"]["name"];
              $target_dir = "../../uploads/food_product_images/";
              $target_file = $target_dir . basename($fileToUpload);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('product_image','food_products','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $sql1 = "UPDATE food_products SET restaurant_id = '$restaurant_id',product_name = '$product_name',product_image='$fileToUpload', category_id ='$category_id', specifications = '$specifications',item_type = '$item_type', lkp_status_id = '$lkp_status_id' WHERE id = '$id'"; 
    
        if ($conn->query($sql1) === TRUE) {
        echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
      }  

    } else{
            $sql1 = "UPDATE food_products SET restaurant_id = '$restaurant_id',product_name = '$product_name',category_id ='$category_id', specifications = '$specifications',item_type = '$item_type',  lkp_status_id = '$lkp_status_id' WHERE id = '$id'";
            if ($conn->query($sql1) === TRUE) {
              echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }     
        }
    $result1=$conn->query($sql1);

    //Delete weight and prices
    $del = "DELETE FROM food_product_weight_prices WHERE product_id = '$id' ";
    $result = $conn->query($del);

    $getAdminComm = getIndividualDetails('food_vendors','id',$_SESSION['food_vendor_user_id']);
    $adminComssion = $getAdminComm['admin_comission'];

    $product_weights = $_REQUEST['weight_type_id'];
    foreach($product_weights as $key=>$value){

        $product_weights1 = $_REQUEST['weight_type_id'][$key];
        $vendor_price = $_REQUEST['product_price'][$key];
        $admin_price = (($adminComssion/ 100) * $vendor_price)+$vendor_price;
        if($product_weights1 && $vendor_price!=''){
        $sql = "INSERT INTO food_product_weight_prices ( `product_id`,`weight_type_id`,`vendor_price`,`admin_price`) VALUES ('$id','$product_weights1','$vendor_price','$admin_price')";
        $result = $conn->query($sql);
        }
    }

    //Delete Ingredient and prices
    $del = "DELETE FROM food_product_ingredient_prices WHERE product_id = '$id' ";
    $result = $conn->query($del);

    $product_ingredients = $_REQUEST['ingredient_name_id'];
    foreach($product_ingredients as $key=>$value){

        $product_ingredients1 = $_REQUEST['ingredient_name_id'][$key];
        $ingredient_price = $_REQUEST['ingredient_price'][$key];
        $admin_price = (($adminComssion/ 100) * $ingredient_price)+$ingredient_price;
        if($product_ingredients1 && $ingredient_price!=''){
        $sql = "INSERT INTO food_product_ingredient_prices ( `product_id`,`ingredient_name_id`,`ingredient_price`,`admin_price`) VALUES ('$id','$product_ingredients1','$ingredient_price','$admin_price')";
        $result = $conn->query($sql);
        }
    }
     
     if($result1==1){
        echo "<script type='text/javascript'>window.location='food_products.php?msg=success'</script>";
    } else {
        echo "<script type='text/javascript'>window.location='food_products.php?msg=fail'</script>";
    }
}
?>

      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Items</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getProductsData = getAllDataWhereWithActive('food_products','id',$id); 
                $getProducts = $getProductsData->fetch_assoc();
                $getCategories = getAllDataWhereWithActive('food_category','vendor_id',$_SESSION['food_vendor_user_id']);
                $getProductTypes = getAllDataWithStatus('food_product_type','0');
                ?>
                
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="post" enctype="multipart/form-data">
                  <?php $getFoodVendors = getItemsByVendorId('food_vendors','id',$_SESSION['food_vendor_user_id']); ?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Resturant</label>
                    <select name="restaurant_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Resturant</option>
                      <?php while($row = $getFoodVendors->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getProducts['restaurant_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['restaurant_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Category</label>
                    <select id="form-control-3" name="category_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Category</option>
                      <?php while($row = $getCategories->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $getProducts['category_id']) { echo "selected=selected"; }?> ><?php echo $row['category_name']; ?></option>
                    <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Product Name</label>
                    <input type="text" class="form-control" id="form-control-2" name="product_name" data-error="Please enter product name." required value="<?php echo $getProducts['product_name']; ?>">
                    <div class="help-block with-errors"></div>
                  </div>                  
                 
                 <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/food_product_images/'.$getProducts['product_image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                 </div>
                  <?php $id = $_GET['pid'];
                    $getQry = "SELECT * FROM food_product_weight_prices where product_id = '$id'";
                    $result2 = $conn->query($getQry);
                  ?>
                    <?php while($row2 = $result2->fetch_assoc()) { ?>
                      
                        <div class="input-field form-group col-md-6">
                            <label for="form-control-3" class="control-label">Choose Weight Type</label>
                            <?php $result = getAllDataWithStatus('food_product_weights','0'); ?>                                                
                            <select name="weight_type_id[]" required id="form-control-3" class="custom-select" data-error="This field is required." required>
                                <?php while($row = $result->fetch_assoc()) { ?>
                                <?php $getTermName =getAllDataWhereWithActive('food_product_weights',$clause,$row2['weight_type_id']); ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $row2['weight_type_id']) { echo "Selected"; } ?>><?php echo $row['weight_type']; ?></option>
                                <?php } ?>
                            </select>  
                            <div class="help-block with-errors"></div>
                        </div>
                      <?php $id = $_GET['pid'];
                            $foodIngrePrice = "SELECT * FROM food_product_weight_prices where product_id = '$id'";
                            $foodIngrePriceData = $conn->query($foodIngrePrice);
                            $foodIngrePriceAllData = $foodIngrePriceData->fetch_assoc();
                      ?>
                        <div class="form-group col-md-6">
                          <label for="form-control-2" class="control-label">Product Price</label>                         
                          <input type="text" class="form-control" id="form-control-2" name="product_price[]" required onkeypress="return isNumberKey(event)" data-error="Please enter product actual price." placeholder="Actual Price" required value="<?php echo $row2['vendor_price']; ?>">
                          <div class="help-block with-errors"></div>
                        </div>
                      
                    <?php } ?>
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Choose More Weights&nbsp;</label>
                     <a href="javascript:void(0);"  ><img src="add-icon.png" onkeypress="return isNumberKey(event)" onclick="addInput('dynamicInput');"/></a>
                  </div>
                  <div id="dynamicInput" class="input-field col s12"></div>
                 
                      

                    <?php $id = $_GET['pid'];
                      $foodIngrtPrice1 = "SELECT * FROM food_product_ingredient_prices where product_id = '$id'";
                      $foodIngrtPriceData1 = $conn->query($foodIngrtPrice1);
                    ?>
                    <?php while($row2 = $foodIngrtPriceData1->fetch_assoc()) { ?>
                    
                      <div class="form-group col-md-6">
                          <label for="form-control-3" class="control-label">Choose Ingredient Type</label>
                          <?php $result = getAllDataWithStatus('food_ingredients','0'); ?>                                                
                              <select name="ingredient_name_id[]" id="form-control-3" class="custom-select" >
                                  <?php while($row = $result->fetch_assoc()) { ?>
                                  <?php $getTermName =getAllDataWhereWithActive('food_ingredients',$clause,$row2['ingredient_name_id']); ?>
                                      <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $row2['ingredient_name_id']) { echo "Selected"; } ?>><?php echo $row['ingredient_name']; ?></option>
                                  <?php } ?>
                              </select>
                          <div class="help-block with-errors"></div>
                      </div>
                      <?php $id = $_GET['pid'];
                            $foodIngrtPriceQry = "SELECT * FROM food_product_ingredient_prices where product_id = '$id'";
                            $foodIngrtPriceQryData = $conn->query($foodIngrtPriceQry);
                            $foodIngrtAllPriceQryData = $foodIngrtPriceQryData->fetch_assoc();
                      ?>
                      <div class="form-group col-md-6">
                        <label for="form-control-2" class="control-label">Ingredient Price</label>                         
                        <input type="text" class="form-control" id="form-control-2" name="ingredient_price[]" required onkeypress="return isNumberKey(event)" placeholder="Ingredient Price" value="<?php echo $row2['ingredient_price']; ?>">
                        <div class="help-block with-errors"></div>
                      </div>

                    <?php }?>
                    <div class="form-group">    
                        <label for="form-control-2" class="control-label">Choose More Ingredients&nbsp;</label>
                         <a href="javascript:void(0);"  ><img src="add-icon.png" onkeypress="return isNumberKey(event)" onclick="addInput1('dynamicInput1');"/></a>
                    </div>  
                    <div id="dynamicInput1" class="input-field col s12"></div>
                    
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Item Type</label>
                    <select id="form-control-3" name="item_type" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Item Type</option>
                      <?php while($row = $getProductTypes->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $getProducts['item_type']) { echo "selected=selected"; }?> ><?php echo $row['product_type']; ?></option>
                    <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Short Description</label>
                    <textarea name="specifications" class="form-control" placeholder="Product Info" data-error="This field is required." required><?php echo $getProducts['specifications']; ?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getProducts['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <button type="submit" name="submit" value="Submit"  class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <?php include_once 'admin_includes/footer.php'; ?>
      <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
      <script src="js/multi_image_upload.js"></script>
      <link rel="stylesheet" type="text/css" href="css/multi_image_upload.css">
      <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
<?php
    $sql1 = "SELECT * FROM  food_product_weights where lkp_status_id = '0'";
    $result1 = $conn->query($sql1);                                    
?>

<?php while($row = $result1->fetch_assoc()) { 
   $choices1[] = $row['id'];
   $choices_names[] = $row['weight_type'];
} ?>
<?php
    $getFoodIng = "SELECT * FROM  food_ingredients where lkp_status_id = '0'";
    $getFoodIngAll = $conn->query($getFoodIng);                                    
?>

<?php while($row = $getFoodIngAll->fetch_assoc()) { 
   $choices2[] = $row['id'];
   $choices_names1[] = $row['ingredient_name'];
} ?>
<script type="text/javascript">

function addInput(divName) {
    var choices = <?php echo json_encode($choices1); ?>; 
    var choices_names = <?php echo json_encode($choices_names); ?>;      
    var newDiv = document.createElement('div');
    newDiv.className = 'new_appen_class';
    var selectHTML = "";    
    selectHTML="<div class='input-field form-group col-md-6'><select required name='weight_type_id[]' id='form-control-3' class='custom-select' style='display:block !important'><option value=''>Select Weighy Type</option>";
    var newTextBox = "<div class='form-group col-md-4'><input type='text' onkeypress='return isNumberKey(event)' onclick='addInput('dynamicInput');' required name='product_price[]' class='form-control' id='form-control-2' placeholder='Product Price'></div>";
    removeBox="<div class='input-field  form-group col-md-2'><a class='remove_button' ><img src='remove-icon.png'/></a></div><div class='clearfix'></div>";
    for(i = 0; i < choices.length; i = i + 1) {
        selectHTML += "<option value='" + choices[i] + "'>" + choices_names[i] + "</option>";
    }
    selectHTML += "</select></div>";
    newDiv.innerHTML = selectHTML+ " &nbsp;"+newTextBox +" "+removeBox;
    document.getElementById(divName).appendChild(newDiv);
}

$(document).ready(function() {
    $(dynamicInput).on("click",".remove_button", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent().parent().remove();
    })
    
});
</script>
<script type="text/javascript">
function addInput1(divName1) {
    var choices = <?php echo json_encode($choices2); ?>; 
    var choices_names1 = <?php echo json_encode($choices_names1); ?>;      
    var newDiv = document.createElement('div');
    newDiv.className = 'new_appen_class';
    var selectHTML = "";    
    selectHTML="<div class='input-field form-group col-md-6'><select name='ingredient_name_id[]' id='form-control-3' class='custom-select' style='display:block !important'><option value=''>Select Ingredient Type</option>";
    var newTextBox = "<div class='form-group col-md-4'><input type='text' onkeypress='return isNumberKey(event)' onclick='addInput1('dynamicInput1');' name='ingredient_price[]' class='form-control' id='form-control-2' placeholder='Ingrediet Price'></div>";
    removeBox="<div class='input-field  form-group col-md-2'><a class='remove_button' ><img src='remove-icon.png'/></a></div><div class='clearfix'></div>";
    for(i = 0; i < choices.length; i = i + 1) {
        selectHTML += "<option value='" + choices[i] + "'>" + choices_names1[i] + "</option>";
    }
    selectHTML += "</select></div>";
    newDiv.innerHTML = selectHTML+ " &nbsp;"+newTextBox +" "+removeBox;
    document.getElementById(divName1).appendChild(newDiv);
}

$(document).ready(function() {
    $(dynamicInput1).on("click",".remove_button", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent().parent().remove();
    })
    
});
</script>
<script type="text/javascript">
$(function(){
    $(document).on('click','.ajax_img_del',function(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        var del_confirm = confirm("Are you sure you want to delete?");
        if(del_confirm == true){
        $.ajax({
            type:'POST',
            url:'ajax_delete_image.php',
            data:{'del_id':del_id},
            success: function(data){
                 if(data=="YES"){
                    location.reload();
                 }else{
                    alert("Deleted");  
                 }
             }
        });
        }else{
            location.reload();
        }
    });
});
</script>
<script type="text/javascript">

//Script allowed only numeric value
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
