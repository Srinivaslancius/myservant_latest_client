<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(1);
  if (!isset($_POST['submit']))  {
              echo "fail";
          } else  { 
      $page_name = $_POST['page_name'];
      $meta_title = $_POST['meta_title'];
      $meta_keywords = $_POST['meta_keywords'];
      $meta_description = $_POST['meta_description'];
      $sql = "INSERT INTO service_seo(`page_name`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('$page_name', '$meta_title', '$meta_keywords','$meta_description')";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='service_seo.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='service_seo.php?msg=fail'</script>";
      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Service Seo</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Page Name</label>
                    <input type="text" name="page_name" class="form-control" id="form-control-2" placeholder="Page Name" data-error="Please enter page name" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" id="form-control-2" placeholder="Meta Title" data-error="Please enter meta title" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control" id="form-control-2" placeholder="Meta Keywords" data-error="Please enter meta keywords" required>
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="form-control-2" class="control-label"> Meta Description</label>
                    <textarea name="meta_description" class="form-control" id="category_description" placeholder="Meta Description" data-error="This field is required." required></textarea>
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