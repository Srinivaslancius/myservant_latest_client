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
        <div class="site-content">
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <a href="add_grocery_banners.php" style="float:right">Add Banners</a>
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Banners</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <!-- <th>Brand Id</th> -->
                                    <th>Title</th>
                                    <th>Web Image</th>
                                    <th>App Image</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getBanners = getAllDataWithActiveRecent('grocery_banners'); $i=1; ?>
                                <?php while ($row = $getBanners->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <!-- <td>Brnd345</td> -->
                                    <td><?php echo $row['title']; ?></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_web_image/'.$row['web_image'] ?>" width="100" height="100"></td>
                                    <td><img src="<?php echo $base_url . 'grocery_admin/uploads/grocery_banner_app_image/'.$row['app_image'] ?>" width="100" height="100"></td>
                                    <td><?php $getCities = getAllData('grocery_lkp_cities'); while($getCitiesData = $getCities->fetch_assoc()) { if($row['lkp_city_id'] == $getCitiesData['id']) { echo $getCitiesData['city_name']; } } ?></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_banners'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_banners'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_grocery_banners.php?banner_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> &nbsp; <!-- <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo "grocery_banners" ?>"><i class="zmdi zmdi-delete zmdi-hc-fw" onclick="return confirm('Are you sure you want to delete?')"></i></a> --></td>
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
     <script src="js/forms-plugins.min.js"></script>
    <script src="js/tables-datatables.min.js"></script>
    <script type="text/javascript">
    $("#category,#sub_category,#product,#link,#offer_percentage").hide();
    $("#min_offer_percentage,#max_offer_percentage").removeAttr('required');
      $(document).ready(function () {
        $("#type").change(function() {
            if($(this).val() == 1) {
                $("#category").show();
                $("#sub_category,#link,#product").hide();
                $('.category').val("");
                $(".category").attr("required", "true");
                $(".sub_category,.link,.product").removeAttr('required');
            } else if($(this).val() == 2) {
                $("#sub_category").show();
                $("#category,#link,#product").hide();
                $('.sub_category').val("");
                $(".sub_category").attr("required", "true");
                $(".category,.link,.product").removeAttr('required');
            } else if($(this).val() == 0) {
                $("#link").show();
                $("#category,#sub_category,#product").hide();
                $('.link').val("");
                $(".link").attr("required", "true");
                $(".category,.sub_category,.product").removeAttr('required');
            } else {
                $("#product").show();
                $("#category,#link,#sub_category").hide();
                $('.product').val("");
                $(".product").attr("required", "true");
                $(".category,.link,.sub_category").removeAttr('required');
            }   
        });
        $("#banner_image_type1").click(function() {
            $("#offer_percentage").show();
            $("#min_offer_percentage,#max_offer_percentage").attr("required", "true");
        });
        $("#banner_image_type").click(function() {
            $("#offer_percentage").hide();
            $("#min_offer_percentage,#max_offer_percentage").removeAttr('required');
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
      });
    </script>
  </body>
</html>