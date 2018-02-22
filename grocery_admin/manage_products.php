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
	<style>
	#ui-datepicker-div{
		top:146.483px !important;
	}
	</style>
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
                    <a href="add_manage_products.php" style="float:right">Add Products</a>
                    <h3 class="m-t-0 m-b-5 font_sz_view">View Products</h3>                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>S.no</th>    
                                    <th>Product Name</th>                                
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Update Price</th>
                                    <th>Upload Images</th>
                                    <th>View Price & Images</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Hot Deals</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $getProdDet = getAllDataWithActiveRecent('grocery_products'); $i=1; ?>
                                <?php while ($row = $getProdDet->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>   
                                    <?php 
                                    $pid = $row['id'];
                                    $getProName = "SELECT * FROM grocery_product_name_bind_languages WHERE product_id='$pid' "; 
                                    $getPn = $conn->query($getProName);
                                    $getProName_new = $getPn->fetch_assoc();
                                    ?>
                                    <td><?php echo $getProName_new['product_name']; ?></td>                                 
                                    <?php $catNAme = getIndividualDetails('grocery_category','id',$row['grocery_category_id']); ?>
                                    <td><?php echo $catNAme['category_name']; ?></td>
                                    <?php $subcatNAme = getIndividualDetails('grocery_sub_category','id',$row['grocery_sub_category_id']); ?>
                                    <td><?php echo $subcatNAme['sub_category_name']; ?></td>
                                    <td><a href="update_price.php?pid=<?php echo $row['id']; ?>">Update Price</a></td>
                                    <td><a href="product_images.php?pid=<?php echo $row['id']; ?>">Upload Images</a></td>
                                    <td><a href="#" data-toggle="modal" data-target="#<?php echo $row['id']; ?>">View Images & Prices</a></td>
                                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='grocery_products'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='grocery_products'>In Active</span>" ;} ?></td>
                                    <td> <a href="edit_products.php?product_id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
                                    <td> <a href="edit_deal_date.php?id=<?php echo $row['id']; ?>"><i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i></a></td>
                            
                                    <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header bg-success">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">
                                                <i class="zmdi zmdi-close"></i>
                                              </span>
                                            </button>
                                              <h4 class="modal-title">Images & Prices<span></span></h4>
                                          </div>
                                          <div class="modal-body">
                                        </div>
                                      </div>
                                    </div>
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
    <script type="text/javascript">
      $('input.date-pick').datepicker({minDate: 0, maxDate: "+2M"});
    </script>
  </body>
</html>