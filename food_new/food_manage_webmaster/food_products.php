<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getProductsData = getAllDataWithActiveRecent('food_products'); $i=1; ?>
     
      <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
          <!-- <a href="add_food_products.php" style="float:right">Add Items</a> -->
            <h3 class="m-t-0 m-b-5">Items</h3>
          </div>
           <div class="panel-body">
            <div class="table-responsive">
          <?php $sql = "SELECT food_products.category_id, food_category.category_name FROM food_products LEFT JOIN food_category ON food_products.category_id=food_category.id GROUP BY food_products.category_id";
            $result = $conn->query($sql);
          ?>
          <div class="form-group col-md-4">            
            <select id="select-category" class="custom-select">
              <option value="">Select Category</option>
              <?php while($getAllCategories = $result->fetch_assoc()) {  ?>
                <option value="<?php echo $getAllCategories['category_name']; ?>"><?php echo $getAllCategories['category_name']; ?></option>
              <?php } ?>
            </select>           
          </div>
          <div class="clear_fix"></div>
         
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Restaurant Name</th>
                    <th>Item Name</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getProductsData->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $getRst =  getAllDataWhere('food_vendors','id',$row['restaurant_id']);
                    $getRestName = $getRst->fetch_assoc(); echo $getRestName['restaurant_name']; ?></td>
                    <td><?php echo $row['product_name'];?></td>
                    <td><?php $getCategories =  getAllDataWhere('food_category','id',$row['category_id']);
                    $getCategory = $getCategories->fetch_assoc(); echo $getCategory['category_name']; ?></td>
                    <td><?php if ($row['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['lkp_status_id']." data-tbname='food_products'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['lkp_status_id']." data-incId=".$row['id']." data-tbname='food_products'>In Active</span>" ;} ?></td>
                    <td> <!-- <a href="edit_food_products.php?pid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a> -->&nbsp; <a href="#"><i class="zmdi zmdi-eye zmdi-hc-fw" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class=""></i></a></td>
                     <!-- Open Modal Box  here -->
                    <div id="<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content animated flipInX">
                          <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                <i class="zmdi zmdi-close"></i>
                              </span>
                            </button>
                            <center><h4 class="modal-title">Item Information</h4></center>
                          </div>
                        <div class="modal-body" id="modal_body">
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Name: </div>
                            <div class="col-sm-6"><?php echo $row['product_name'];?></div>
                          </div>  
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Category Name: </div>
                            <div class="col-sm-6"><?php $getCategories = getAllDataWhere('food_category','id',$row['category_id']);
                              $getCategory = $getCategories->fetch_assoc(); echo $getCategory['category_name']; ?> </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Resturant Name: </div>
                            <div class="col-sm-6"><?php $getResturants = getAllDataWhere('food_restaurants','id',$row['restaurant_id']);
                              $getResturantsName = $getResturants->fetch_assoc(); echo $getResturantsName['restaurant_name']; ?> </div>
                          </div>                                                
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Item Desc: </div>
                            <div class="col-sm-6"><?php echo $row['specifications'];?></div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Availability: </div>
                            <div class="col-sm-6"><?php if($row['availability_id'] == 0 ){ echo "In Stock";} else{ echo "Out Of Stock";}?></div>
                          </div> -->                 
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-4">Status: </div>
                            <div class="col-sm-6"><?php if($row['status'] == 0){ echo "Active";}else{ echo "InActive";}?></div>
                          </div>                          

                          <?php $getAllWeightTypes = getAllDataWhere('food_product_weight_prices','product_id',$row['id']);
                           ?>
                          
                              <div class="div-table">
                                    <div class="div-table-row">                                        
                                        <div  class="div-table-col">Weight Type</div>
                                        <div  class="div-table-col">Vendor Item Price</div>
                                        <div  class="div-table-col">Admin Item Price</div>
                                    </div>
                                    <?php while ($getWeight = $getAllWeightTypes->fetch_assoc()) { ?>
                                    <div class="div-table-row">
                                        <div class="div-table-col"><?php $getWeightType = getAllDataWhere('food_product_weights','id',$getWeight['weight_type_id']);
                                          $getWeightTypes = $getWeightType->fetch_assoc(); echo $getWeightTypes['weight_type']; ?></div>
                                        <div class="div-table-col"><?php echo $getWeight['vendor_price']; ?></div>
                                        <div class="div-table-col"><?php echo $getWeight['admin_price']; ?></div>
                                    </div> 
                                    <?php } ?>                                                                      
                              </div>                               
                          <div class="clearfix"></div></br>
                          <?php $getAllIngredientTypes = getAllDataWhere('food_product_ingredient_prices','product_id',$row['id']);
                           ?>
                          <div class="div-table">
                                    <div class="div-table-row">                                        
                                        <div  class="div-table-col">Ingredient Type</div>
                                        <div  class="div-table-col">Vendor Ingredient Price</div>
                                        <div  class="div-table-col">Admin Ingredient Price</div>
                                    </div>
                                    <?php while ($getWeight1 = $getAllIngredientTypes->fetch_assoc()) { ?>
                                    <div class="div-table-row">
                                        <div class="div-table-col"><?php $getIngredientType = getAllDataWhere('food_ingredients','id',$getWeight1['ingredient_name_id']);
                                          $getWeightTypes = $getIngredientType->fetch_assoc(); echo $getWeightTypes['ingredient_name']; ?></div>
                                        <div class="div-table-col"><?php echo $getWeight1['ingredient_price']; ?></div>
                                        <div class="div-table-col"><?php echo $getWeight1['admin_price']; ?></div>
                                    </div> 
                                    <?php } ?>                                                                      
                            </div>
                        </div>
                        <div class="modal-footer">
                          <!--<button type="button" data-dismiss="modal" class="btn btn-success">Continue</button>-->
                          <button type="button" data-dismiss="modal" class="btn btn-success">Close</button>
                          <style>
                            #modal_body{
                              font-size:14px;
                              padding-top:30px;
                              padding-left: 0px;
                              font-family:Roboto,sans-serif;
                            }
                            .div-table {
                              display: table;         
                              /*width: auto;*/
                              width: 80%;
                             margin: auto;
                              background-color: #eee;         
                              border: 1px solid #666666;         
                              border-spacing: 5px; /* cellspacing:poor IE support for  this */
                            }
                            .div-table-row {
                              display: table-row;
                              width: auto;
                              clear: both;
                            }
                            .div-table-col {
                              float: left; /* fix for  buggy browsers */
                              display: table-column;         
                              /*width: 150px;*/
                              width: 150px;
                              background-color: #ccc;  
                            }
                          </style>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal Box  here -->
                  </tr>
                  <?php  $i++; } ?>
                </tbody>     
              </table>
            </div>
          </div>
        </div>
      </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>