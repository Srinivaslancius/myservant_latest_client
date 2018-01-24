<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['cid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
  $description = $_POST['description'];
  $lkp_status_id = $_POST['lkp_status_id'];

                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
                    $sql = "UPDATE food_how_can_i_help_you SET description = '$description',lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='food_howcanhelp_you.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='food_howcanhelp_you.php?msg=fail'</script>";
                    }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                
      
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">How can I Help You</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getHowCanIHelpYouData = getAllDataWhere('food_how_can_i_help_you','id',$id);
              $getHowCanIHelpYou = $getHowCanIHelpYouData->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  
        
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <textarea name="description" class="form-control" id="description" data-error="This field is required." required><?php echo $getHowCanIHelpYou['description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getHowCanIHelpYou['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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