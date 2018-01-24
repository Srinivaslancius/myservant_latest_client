<?php include_once 'admin_includes/main_header.php'; ?>
<?php
error_reporting(0);
$id = $_GET['branchid'];
 if (!isset($_POST['submit']))  {
            echo "fail";
    } else  {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $lkp_status_id = $_POST['lkp_status_id'];
            $sql = "UPDATE `services_our_branches` SET title='$title', address='$address', lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='services_our_branches.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='services_our_branches.php?msg=fail'</script>";
            }
        }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Delivery Areas</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getOurBranches = getAllDataWhere('services_our_branches','id',$id);
              $getOurBranchesData = $getOurBranches->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Title" data-error="Please enter title" required value="<?php echo $getOurBranchesData['title'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Address</label>
                    <textarea type="text" name="address" class="form-control" id="category_description" placeholder="Address" data-error="Please enter address." required><?php echo $getOurBranchesData['address'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                 <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getOurBranchesData['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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