<?php include_once 'admin_includes/main_header.php'; ?>
<link rel="stylesheet" href="css/chosen.min.css">

<?php  
$id = $_GET['gid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $services_category_id = $_POST['services_category_id'];
    $services_sub_category_id = $_POST['services_sub_category_id'];
    $group_name = $_POST['group_name'];
    $group_description = $_POST['group_description'];
    $meta_title = $_POST['meta_title'];
    $meta_keywords = $_POST['meta_keywords'];
    $meta_desc = $_POST['meta_desc'];
    $lkp_status_id = $_POST['lkp_status_id'];

      $sql = "UPDATE `services_groups` SET services_category_id = '$services_category_id', services_sub_category_id = '$services_sub_category_id', group_name = '$group_name', group_description = '$group_description',meta_title = '$meta_title',meta_keywords = '$meta_keywords',meta_desc = '$meta_desc', lkp_status_id='$lkp_status_id' WHERE id = '$id' ";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='services_groups.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='services_groups.php?msg=fail'</script>";
      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Groups</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getGroups = getAllDataWhere('services_groups','id',$id);
              $getGroupsData = $getGroups->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getServicesCategories = getAllDataWithStatus('services_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Services Categories</label>
                    <select id="form-control-3" name="services_category_id" class="custom-select" data-error="This field is required." required onChange="getSubCategory(this.value);" data-plugin="select2" data-options="{ placeholder: 'Select a Category', allowClear: true }">
                      <option value="">Select Services Categories</option>
                      <?php while($row = $getServicesCategories->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getGroupsData['services_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getServicesSubCategories = getAllDataWithStatus('services_sub_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Services Sub Categories</label>
                    <select id="services_sub_category_id" name="services_sub_category_id" class="custom-select" data-error="This field is required." required data-plugin="select2" data-options="{ placeholder: 'Select a Sub Category', allowClear: true }">
                      <option value="">Select Services Sub Categories</option>
                      <?php while($row = $getServicesSubCategories->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getGroupsData['services_sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Groups Name</label>
                    <input type="text" name="group_name" class="form-control" id="form-control-2" data-error="Please enter a Group Name" required value="<?php echo $getGroupsData['group_name'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Gropu Description</label>
                    <textarea name="group_description" class="form-control" id="category_description" data-error="This field is required." required><?php echo $getGroupsData['group_description'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" data-error="Please enter a Meta Title" required value="<?php echo $getGroupsData['meta_title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" data-error="Please enter a Meta Keywords" required value="<?php echo $getGroupsData['meta_keywords'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" data-error="This field is required." required><?php echo $getGroupsData['meta_desc'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getGroupsData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
