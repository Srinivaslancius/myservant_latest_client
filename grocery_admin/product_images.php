<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Cosmos</title>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/cosmos.min.css">
    <link rel="stylesheet" href="css/application.min.css">
  </head>
  <body class="layout layout-header-fixed layout-left-sidebar-fixed">
    <div class="site-overlay"></div>
    <div class="site-header">
        <?php include_once './main_header.php';?>
    </div>
    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
            <?php include_once './side_menu.php';?>
        </div>
      </div>
      <div class="site-right-sidebar">
        <?php include_once './right_slide_toggle.php';?>
      </div>
        <?php $pid = $_GET['pid']; ?>
        <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 

            //echo "<pre>"; print_r($_FILES); die;
            $product_images = $_FILES['product_images']['name'];
            foreach($product_images as $key=>$value){
                if(!empty($value)) {
                    $product_images1 = uniqid().$_FILES['product_images']['name'][$key];
                    $file_tmp = $_FILES["product_images"]["tmp_name"][$key];
                    $file_destination = 'uploads/product_images/' . $product_images1;
                    move_uploaded_file($file_tmp, $file_destination);    
                    $sql = "INSERT INTO grocery_product_bind_images ( `product_id`,`image`) VALUES ('$pid','$product_images1')";
                    $result = $conn->query($sql);
                }
            }
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='manage_products.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='manage_products.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Product Images</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="clear_fix"></div>
                            <div class="input_fields_container">
                                <div class="form-group">
                                    <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Product Image</label>
                                    <div class="col-sm-6 col-md-2">
                                        <label class="btn btn-default file-upload-btn">Choose file...
                                            <input id="form-control-22" class="file-upload-input" type="file" name="product_images[]" accept="image/*" required>
                                        </label> (width : 420px ; height : 420px)
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <span><button type="button" class="btn btn-success add_more_button"> <i class="zmdi zmdi-plus-circle zmdi-hc-fw"></i></button></span>                                    
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Product Images</h3>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>                                    
                                    <th>Product Image</th>
                                    <!-- <th>Actions</th> -->
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getProductImages = getAllDataWhere('grocery_product_bind_images','product_id',$pid); $i=1; ?>
                                <?php while ($row = $getProductImages->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/product_images/'.$row['image']; ?>"  id="output" height="60" width="60"/></td>
                                    <!-- <td><span><a href=""><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a></span></td> -->
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        
    <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>


    <script>
        $(document).ready(function() {
        var max_fields_limit      = 10; //set limit for maximum input fields
        var x = 1; //initialize counter for text box
        $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
            e.preventDefault();
            if(x < max_fields_limit){ //check conditions
                x++; //counter increment
                $('.input_fields_container').append('<div><div class="row"><div class="form-group"><label class="col-sm-3 col-md-4 control-label" for="form-control-22">Product Image</label><div class="col-sm-6 col-md-2"><label class="btn btn-default file-upload-btn">Choose file...<input id="form-control-22" class="file-upload-input" type="file" name="product_images[]" required></label></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="remove_field btn btn-warning"><i class="zmdi zmdi-minus-circle zmdi-hc-fw"></i></a></div></div></div>'); //add input field
            }
        });  
        $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
  </body>
</html>