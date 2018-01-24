<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  $services_category_id = $_POST['services_category_id'];
  $services_sub_category_id = $_POST['services_sub_category_id'];
  $group_name = $_POST['group_name'];
  $group_description = $_POST['group_description'];
  $meta_title = $_POST['meta_title'];
  $meta_keywords = $_POST['meta_keywords'];
  $meta_desc = $_POST['meta_desc'];
  $lkp_status_id = $_POST['lkp_status_id'];
  
    $sql = "INSERT INTO services_groups (`services_category_id`, `services_sub_category_id`, `group_name`,`group_description`, `meta_title`, `meta_keywords`, `meta_desc`, `lkp_status_id`) VALUES ('$services_category_id', '$services_sub_category_id', '$group_name','$group_description', '$meta_title', '$meta_keywords', '$meta_desc', '$lkp_status_id')"; 
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
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getServicesCategories = getAllDataWithStatus('services_category','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Service Category</label>
                    <select name="services_category_id" class="custom-select" data-error="This field is required." required onChange="getSubCategory(this.value);">
                      <option value="">Select Service Category</option>
                      <?php while($row = $getServicesCategories->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Service Sub Category</label>
                    <select name="services_sub_category_id" id="services_sub_category_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Service Sub Category</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Group Name</label>
                    <input type="text" name="group_name" class="form-control" id="form-control-2" placeholder="Group Name" data-error="Please enter Group Name" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Group Description</label>
                    <textarea name="group_description" class="form-control" id="category_description" placeholder="Group Description" data-error="Please enter Group Description." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter Meta Title" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter Meta Keywords" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_desc" class="form-control" id="meta_desc" placeholder="Description" data-error="This field is required." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
<script type="text/javascript">
  function getSubCategory(val) {
    $.ajax({
    type: "POST",
    url: "get_subcategories.php",
    data:'services_category_id='+val,
    success: function(data){
        $("#services_sub_category_id").html(data);
    }
    });
  }
</script>
