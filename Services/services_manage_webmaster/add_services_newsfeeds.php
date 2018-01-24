<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  //echo "<pre>"; print_r($_POST); die;
  $title = $_POST['title'];
  $news_feed_url = $_POST['news_feed_url'];
  $lkp_status_id = $_POST['lkp_status_id'];
  

        $sql = "INSERT INTO services_newsfeed (`title`, `news_feed_url`,`lkp_status_id`) VALUES ('$title', '$news_feed_url','$lkp_status_id')"; 
        if($conn->query($sql) === TRUE){
           echo "<script type='text/javascript'>window.location='services_newsfeeds.php?msg=success'</script>";
        } else {
           echo "<script type='text/javascript'>window.location='services_newsfeeds.php?msg=fail'</script>";
        }
        }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">News Feed</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="form-control-2" placeholder="Title" data-error="Please enter Title" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">News Feed Url</label>
                    <input type="url" name="news_feed_url" class="form-control" id="form-control-2" placeholder="News Feed url" data-error="Please enter News Feed Url." required>
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
<!-- Script for display category based on banner type -->
<script type="text/javascript">
$("#service_category_id").hide();
  $(document).ready(function () {
    $("input[name='lkp_banner_type_id']").click(function () {
      if ($("#lkp_banner_type_id").is(":checked")) {
          $("#service_category_id").show();
          $(".check_valid_cust").attr("required", "true");
      } else {
          $("#service_category_id").hide();
          $('.check_valid_cust').removeAttr('required');
      }
    });
  });
</script>