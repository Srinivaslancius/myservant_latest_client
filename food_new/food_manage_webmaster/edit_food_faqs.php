<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['uid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
      $question = $_POST['question'];
      $answer = $_POST['answer'];
      $lkp_status_id = $_POST['lkp_status_id'];

      $sql = "UPDATE food_faqs SET question = '$question', answer = '$answer', lkp_status_id = '$lkp_status_id' WHERE id = '$id' ";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='faqs.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='faqs.php?msg=fail'</script>";
      }

  }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Help Center Faqs</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getAllFoodFaqs = getAllDataWhere('food_faqs','id',$id);
                    $getFoodFaqs = $getAllFoodFaqs->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Question</label>
                    <textarea name="question" class="form-control" id="question" placeholder="Answer" data-error="Please enter Answer." required><?php echo $getFoodFaqs['question'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>                 
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Answer</label>
                    <textarea name="answer" class="form-control" id="category_description" placeholder="Answer" data-error="Please enter Answer." required><?php echo $getFoodFaqs['answer'];?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('lkp_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="lkp_status_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFoodFaqs['lkp_status_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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