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

      <?php $cid = $_GET['cid']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 

            //echo "<pre>"; print_r($_POST); die;
            $title = $_REQUEST['title'];
            $description = $_REQUEST['description'];

            if($_FILES["banner"]["name"]!='') {

                $banner = uniqid().$_FILES["banner"]["name"];
                $target_dir = "uploads/grocery_content_banners/";
                $target_file = $target_dir . basename($banner);
                move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file);
                $sql = "UPDATE `grocery_content_pages` SET title = '$title', description = '$description', image = '$banner' WHERE id = '$cid' ";
            } else {

                $sql = "UPDATE `grocery_content_pages` SET title = '$title', description = '$description' WHERE id = '$cid' ";
            }
            $result = $conn->query($sql);            
           
            if( $result == 1){
                echo "<script type='text/javascript'>window.location='content_page.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='content_page.php?msg=fail'</script>";
            }
        }
        ?>

        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Content Page</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <?php $contentData = getIndividualDetails('grocery_content_pages','id',$cid); ?>

                        <form class="form-horizontal" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Title</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" class="form-control" id="form-control-3" placeholder="Enter Title" name="title" required="required" value="<?php echo $contentData['title']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                            
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-22">Banner Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($contentData['image']!='') { ?>
                                <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_content_banners/'.$contentData['image']; ?>"  id="output" height="100" width="100"/>
                            <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input id="form-control-22" class="file-upload-input" type="file" name="banner" accept="image/*" onchange="loadFile(event)">
                                    </label>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3  col-md-4 control-label" for="form-control-8">Content</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea id="form-control-8" class="form-control" rows="3" name="description" required="required"> <?php echo $contentData['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
        

    <?php include_once 'footer.php'; ?>
  </body>
</html>