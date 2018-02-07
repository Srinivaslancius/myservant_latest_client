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
      <?php $offer_zone_id = $_GET['offer_zone_id']; ?>
      <?php
        if (!isset($_POST['submit']))  {
          echo "fail";
        } else  { 
            //echo "<pre>"; print_r($_POST); die;
            $offer_code = $_REQUEST['offer_code'];
            $max_offer_percentage = $_REQUEST['max_offer_percentage'];
            $min_offer_percentage = $_REQUEST['min_offer_percentage'];
            $offer_description = $_REQUEST['offer_description'];
            $offer_reward_points = $_REQUEST['offer_reward_points'];
            $offer_start_date = date('y-m-d',strtotime($_REQUEST['offer_start_date']));
            $offer_end_date = date('y-m-d',strtotime($_REQUEST['offer_end_date']));
            if($_FILES["offer_image"]["name"]!='') {
                $offer_image = uniqid().$_FILES["offer_image"]["name"];
                $target_dir = "uploads/grocery_offer_zone_images/";
                $target_file = $target_dir . basename($offer_image);
                move_uploaded_file($_FILES["offer_image"]["tmp_name"], $target_file);
                $sql = "UPDATE `grocery_offer_zone` SET offer_code = '$offer_code', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', offer_description = '$offer_description', offer_start_date = '$offer_start_date', offer_end_date = '$offer_end_date', offer_image = '$offer_image', offer_reward_points = '$offer_reward_points' WHERE id = '$offer_zone_id' ";
            } else{
                $sql = "UPDATE `grocery_offer_zone` SET offer_code = '$offer_code', max_offer_percentage = '$max_offer_percentage', min_offer_percentage = '$min_offer_percentage', offer_description = '$offer_description', offer_start_date = '$offer_start_date', offer_end_date = '$offer_end_date', offer_reward_points = '$offer_reward_points' WHERE id = '$offer_zone_id' ";
            }
            //echo $sql; die;
            if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>window.location='grocery_offer_zone.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='grocery_offer_zone.php?msg=fail'</script>";
            }
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Add Offer Zone</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php $getOfferZones = getIndividualDetails('grocery_offer_zone','id',$offer_zone_id); ?>
                        <form class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer Code</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" style="text-transform:uppercase" name="offer_code" class="form-control" id="user_input" onblur="checkUserAvailTest()" placeholder="Enter Offer Code" value="<?php echo $getOfferZones['offer_code']; ?>" required>
                                    <span id="input_status" style="color: red;"></span>
                                    <input type="hidden" id="table_name" value="grocery_offer_zone">
                                    <input type="hidden" id="column_name" value="offer_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Offer Image</label>
                                <div class="col-sm-6 col-md-4">
                                    <?php if($getOfferZones['offer_image']!='') { ?>
                                        <img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_offer_zone_images/'.$getOfferZones['offer_image']; ?>" id="output1" height="100" width="100"/>
                                    <?php } ?>
                                    <label class="btn btn-default file-upload-btn">Choose file...
                                        <input class="file-upload-input" type="file" name="offer_image" multiple="multiple" accept="image/*" id="offer_image" onchange="loadFile1(event)">
                                    </label> (width : 550px ; height : 200px)
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer Start Date</label>
                                <div class="col-sm-6 col-md-4">
                                    <input class="start_date_pick form-control" data-format="yyyy-MM-dd" type="text" placeholder="Offer Start Date" name="offer_start_date" value="<?php echo $getOfferZones['offer_start_date']; ?>" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer End Date</label>
                                <div class="col-sm-6 col-md-4">
                                    <input class="end_date_pick form-control" data-format="yyyy-MM-dd" type="text" placeholder="Offer End Date" name="offer_end_date" value="<?php echo $getOfferZones['offer_end_date']; ?>" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer Description</label>
                                <div class="col-sm-6 col-md-4">
                                    <textarea name="offer_description" class="form-control" placeholder="Offer Description" required><?php echo $getOfferZones['offer_description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-3">Minimum Offer Percentage</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="min_offer_percentage" class="form-control valid_price_dec" id="min_offer_percentage" value="<?php echo $getOfferZones['min_offer_percentage']; ?>" placeholder="Enter Minimum Offer Percentage" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-3">Maximum Offer Percentage</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="max_offer_percentage" class="form-control valid_price_dec" id="max_offer_percentage" value="<?php echo $getOfferZones['max_offer_percentage']; ?>" placeholder="Enter Maximum Offer Percentage" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer Reward Points</label>
                                <div class="col-sm-6 col-md-4">
                                    <input type="text" name="offer_reward_points" class="form-control valid_mobile_num" id="offer_reward_points" value="<?php echo $getOfferZones['offer_reward_points']; ?>" placeholder="Enter Offer Reward Points" required>
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
        </div>
        <?php include_once 'footer.php'; ?>
    <script src="js/dashboard-3.min.js"></script>
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
    <script type="text/javascript">
    $('.start_date_pick').datepicker({numberOfMonths: 2,
        onSelect: function(selected) {
            $(".end_date_pick").datepicker("option","minDate", selected)
        }
    });
    $('.end_date_pick').datepicker({numberOfMonths: 2,
        onSelect: function(selected) {
            $(".start_date_pick").datepicker("option","maxDate", selected)
        }
    });
    $("#min_offer_percentage,#max_offer_percentage").blur(function () {
        if(parseInt($('#min_offer_percentage').val()) > parseInt($('#max_offer_percentage').val())) {
          alert("The Maximum Percentage must be larger than the Minimum Percentage");
          $('#min_offer_percentage').val('');
          $('#max_offer_percentage').val('');
          return false;
        }
        if(parseInt($('#min_offer_percentage').val()) == 0 && parseInt($('#max_offer_percentage').val()) == 0) {
          alert("The Maximum Percentage and the Minimum Percentage should be greater than zero");
          $('#min_offer_percentage').val('');
          $('#max_offer_percentage').val('');
          return false;
        }
    });
    </script>
  </body>
</html>