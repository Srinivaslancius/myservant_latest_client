<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['tid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
      $title = $_POST['title'];
      $description = $_POST['description'];
      $lkp_status_id = $_POST['lkp_status_id'];

          $sql = "UPDATE food_cusine_types SET title = '$title',lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_cusine.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_cusine.php?msg=fail'</script>";
                    }
                   
                
      
  }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Food Cusine</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getAllFoodCusineData = getAllDataWhere('food_cusine_types','id',$id);
                    $getFoodCusineData = $getAllFoodCusineData->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Title" data-error="Please enter Title" required value="<?php echo $getFoodCusineData['title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFoodCusineData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
<?php include_once 'admin_includes/footer.php'; ?>