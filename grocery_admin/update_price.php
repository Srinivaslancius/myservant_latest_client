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

            $lkp_city_id = $_POST['lkp_city_id'];  
            $selling_price1 = $_REQUEST['selling_price'];          
            foreach($selling_price1 as $key=>$value){
                if(!empty($value)) {                  
                    $weight_type =  $_REQUEST['weight_type'][$key];
                    $mrp_price =    $_REQUEST['mrp_price'][$key];
                    $selling_price = $_REQUEST['selling_price'][$key];                   
                    $offer_type = $_REQUEST['select_opt'][$key];
                    if($offer_type == 0) {
                        $offer_percentage = 0;
                    } else {
                        $offer_percentage = $_REQUEST['offer_percentage'][$key];
                    }
                    //echo "<pre>"; print_r($buttonRadios); die;
                    $sql = "INSERT INTO grocery_product_bind_weight_prices ( `product_id`,`lkp_city_id`, `weight_type`, `mrp_price`, `selling_price` , `offer_type`, `offer_percentage` ) VALUES ('$pid','$lkp_city_id', '$weight_type', '$mrp_price', '$selling_price', '$offer_type', '$offer_percentage')";
                    $result = $conn->query($sql);
                }
            }
            
            echo "<script type='text/javascript'>window.location='update_price.php?pid=".$pid."'</script>";
        }
        ?>
        <div class="site-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="m-y-0 font_sz_view">Update Price</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        
                        <form class="form-horizontal" method="post" autocomplete="off">

                            <div class="form-group" style="margin-right:50px;margin-left:50px">
                                <label class="col-sm-3 col-md-4 control-label" for="form-control-9">Select City</label>
                                <div class="col-sm-6 col-md-4">
                                    <select id="form-control-1" name="lkp_city_id" class="form-control" data-plugin="select2" data-options="{ theme: bootstrap }" required>
                                        <option value="">-- Select City --</option>
                                        <?php $getCities = getAllDataWithStatus('grocery_lkp_cities','0');?>
                                        <?php while($row = $getCities->fetch_assoc()) {  ?>
                                            <option value="<?php echo $row['id']; ?>" ><?php echo $row['city_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="clear_fix"></div>

                            <div class="input_fields_container" >
							
                                <div style="border:1px solid #ddd;padding-top:20px;margin-left:60px;margin-right:60px">
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer</label>
                                        <!-- <div class="btn-group col-sm-6 col-md-4" >
                                             <label class="btn btn-outline-primary">
                                                <input type="radio" name="buttonRadios_1[]" required onclick="check_offer(1)" value='1' > Yes
                                            </label>
                                            <label class="btn btn-outline-primary">
                                                <input type="radio" name="buttonRadios_1[]" required onclick="check_offer(0)" value='0' > No &nbsp;
                                            </label>
                                        </div> -->
                                        <div class="btn-group col-sm-6 col-md-4" >
                                            <select onChange="check_offer(this.value)" class="form-control" name="select_opt[]">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <input type="hidden" id="setRaioVal">
                                    <div class="form-group offer_price" style="display:none">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Percentage</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" name="offer_percentage[]" onChange="calculatePrice()" id="offer_per" placeholder="Offer Percentage (%)" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Weight (Ex: 100 Gms etc..)</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control" name="weight_type[]" id="form-control-3" placeholder="Weights (Ex: 100 Gms etc..)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">MRP</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" name="mrp_price[]" id="mrp_price" placeholder="Enter MRP" onkeyup="getPrice(this.value);" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-control-3" class="col-sm-3 col-md-4 control-label">Selling Price</label>
                                        <div class="col-sm-6 col-md-4">
                                            <input type="text" class="form-control valid_mobile_num" name="selling_price[]" id="selling_price" placeholder="Enter Selling Price" required readonly>
                                        </div>
                                       
                                    </div>
                                </div>
								 <div class="col-sm-8 col-md-8">
								 </div>
								 <div class="col-sm-4 col-md-4"style="margin-top:10px">
                                            <span><button type="button" class="btn btn-success add_more_button"> <i class="zmdi zmdi-plus-circle zmdi-hc-fw" ></i></button></span>
                                </div>
                            </div>

                            <br />
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <?php 
                $i=1; 
                $getProPriceInfo = "SELECT * FROM grocery_product_bind_weight_prices WHERE product_id='$pid' " ; 
                $getProIn = $conn->query($getProPriceInfo);
            ?>
            <div class="panel panel-default panel-table m-b-0">
                <div class="panel-heading">
                    <h3 class="m-t-0 m-b-5 font_sz_view">View States</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" id="table-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>City</th>                                    
                                    <th>Offer</th>
                                    <th>Offer Percentage</th>
                                    <th>Weight</th>
                                    <th>MRP</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($getProdInfo = $getProIn->fetch_assoc() ) {?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <?php $getCityName= getIndividualDetails('grocery_lkp_cities','id',$getProdInfo['lkp_city_id']); ?>
                                    <?php 
                                        if($getProdInfo['offer_type'] == 0) {
                                            $checkOffer = "No";
                                            $offerPer= "-";
                                        } else {
                                            $checkOffer = "Yes";
                                            $offerPer= $getProdInfo['offer_percentage'] . ' %';
                                        }
                                    ?>
                                    <td><?php echo $getCityName['city_name']; ?></td>
                                    <td><?php echo $checkOffer; ?></td>
                                    <td><?php echo $offerPer; ?></td>
                                    <td><?php echo $getProdInfo['weight_type']; ?></td>
                                    <td><?php echo $getProdInfo['mrp_price']; ?></td>
                                    <td><?php echo $getProdInfo['selling_price']; ?></td>
                                    <td><?php if ($getProdInfo['lkp_status_id']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$getProdInfo['id']." data-status=".$getProdInfo['lkp_status_id']." data-tbname='grocery_product_bind_weight_prices'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$getProdInfo['lkp_status_id']." data-incId=".$getProdInfo['id']." data-tbname='grocery_product_bind_weight_prices'>In Active</span>" ;} ?></td>
                                    <td><span><a href="#"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></span></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-footer">
          2017 © Cosmos
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

                $('.input_fields_container').append('<div><div class="row" style="border:1px solid #ddd;margin:60px 60px 0px 60px;padding-top:20px;padding-bottom:10px"><input type="hidden" id="setRaioVal_'+x+'"><div class="form-group"><label for="form-control-3" class="col-sm-3 col-md-4 control-label">Offer</label><div class="btn-group col-sm-6 col-md-4" ><select class="form-control" onChange="check_offer1(this.value,'+x+')" name="select_opt[]"><option value="">Select</option><option value="1">Yes</option><option value="0">No</option></select></div></div><div class="form-group" id="offer_price_'+x+'" style="display:none"><label for="form-control-3" class="col-sm-3 col-md-4 control-label">Percentage</label><div class="col-sm-6 col-md-4"><input type="text" class="form-control" name="offer_percentage[]" id="offer_per_'+x+'" placeholder="Offer Percentage (%)" ></div></div><div class="form-group"><label for="form-control-3" class="col-sm-3 col-md-4 control-label">Weight (Ex: 100 Gms etc..)</label><div class="col-sm-6 col-md-4"><input type="text" class="form-control" id="form-control-3" placeholder="Weight Types" name="weight_type[]" required></div></div><div class="form-group"><label for="form-control-3" class="col-sm-3 col-md-4 control-label">MRP</label><div class="col-sm-6 col-md-4"><input type="text" class="form-control valid_mobile_num" id="form-control-3" placeholder="Enter MRP" name="mrp_price[]" required onkeyup="getPrice1(this.value,'+x+');"></div></div><div class="form-group"><label for="form-control-3" class="col-sm-3 col-md-4 control-label">Selling Price</label><div class="col-sm-6 col-md-4"><input type="text" class="form-control valid_mobile_num" id="selling_price_'+x+'" placeholder="Enter Selling Price" name="selling_price[]" required readonly></div></div><a href="#" style="margin-right:23%;margin-left:3px" class="remove_field btn btn-warning pull-right"><i class="zmdi zmdi-minus-circle zmdi-hc-fw"></i></a><a href="#" class="remove_field btn btn-warning pull-right"><i class="zmdi zmdi-plus-circle zmdi-hc-fw" ></i></a></div></div>'); //add input field

            }
        });  
        $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>

    <script type="text/javascript">
    function check_offer(getRadioVal) {
        if(getRadioVal == 1 ){
            $('.offer_price').css("display", "block");
        } else {
            $('.offer_price').css("display", "none");           
        }      
        $('#setRaioVal').val(getRadioVal);
    }
    function check_offer1(getRadioVal,getIncValue) {
        if(getRadioVal == 1 ){
            $('#offer_price_'+getIncValue).css("display", "block");
        } else {
            $('#offer_price_'+getIncValue).css("display", "none");           
        }
         $('#setRaioVal_'+getIncValue).val(getRadioVal);
    }

    </script>

    <script type="text/javascript">
    function getPrice(Price) {

        if($('#setRaioVal').val()!='') {
            if($('#setRaioVal').val() == 0){         
                $('#selling_price').val(Price);        
            } else {
                //Calculation for selling price            
                var OfferPer = $('#offer_per').val();
                if(OfferPer!='') {
                    var SellingPrice = Price-(Price*(OfferPer/100)); 
                    $('#selling_price').val(SellingPrice);              
                } else {
                    $('#mrp_price, #selling_price').val('');
                    alert("Please enter offer price");
                    return false;
                }                          
            }
        } else {
            $('#mrp_price, #selling_price').val('');
            alert("Please select offer type ");
            return false;
        }                    
    }

    function getPrice1(Price,getIncValue) {

        if($('#setRaioVal_'+getIncValue).val()!='') {            
            if($('#setRaioVal_'+getIncValue).val() == 0){         
                $('#selling_price_'+getIncValue).val(Price);    
            } else {
                //Calculation for selling price            
                var OfferPer = $('#offer_per_'+getIncValue).val();                
                if(OfferPer!='') {
                    var SellingPrice = Price-(Price*(OfferPer/100)); 
                    $('#selling_price_'+getIncValue).val(SellingPrice);              
                } else {
                    $('#selling_price_'+getIncValue).val('');
                    $('#mrp_price_'+getIncValue).val('');
                    alert("Please enter offer price");
                    return false;
                }                          
            }
        } else {
            $('#selling_price_'+getIncValue).val('');
            $('#mrp_price_'+getIncValue).val('');
            alert("Please select offer type ");
            return false;
        }
    }
    </script>

  </body>
</html>