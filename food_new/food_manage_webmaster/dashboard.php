<?php include_once 'admin_includes/main_header.php'; ?>
      <div class="site-content">
        <?php $getUsers = "SELECT * FROM users WHERE lkp_admin_service_type_id = 2 ORDER BY lkp_status_id, id DESC";
          $getUsersData = $conn->query($getUsers);
          $getUsersCount = $getUsersData->num_rows;?>

          <?php $getUsers1 = "SELECT * FROM users WHERE lkp_status_id =0 AND lkp_admin_service_type_id = 2 ORDER BY lkp_status_id, id DESC";
          $getUsersData1 = $conn->query($getUsers1);
          $getUsersCount1 = $getUsersData1->num_rows;?>

          <?php $getUsers2 = "SELECT * FROM users WHERE lkp_status_id =1 AND lkp_admin_service_type_id = 2 ORDER BY lkp_status_id, id DESC";
          $getUsersData2 = $conn->query($getUsers2);
          $getUsersCount2 = $getUsersData2->num_rows;?>
        <div class="row">
          <a href="users.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-danger m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Customers
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-number"><?php echo $getUsersCount ?><br></div>
                Active :  &nbsp;<?php echo $getUsersCount1?> &nbsp;&nbsp;&nbsp; In Active :  &nbsp;<?php echo $getUsersCount2?>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          <?php $getAllFoodDeliveryBoys = "SELECT * FROM food_delivery_boys ORDER BY lkp_status_id, id DESC";
          $getFoodDeliveryBoys = $conn->query($getAllFoodDeliveryBoys);
          $getFoodDeliveryBoysCount = $getFoodDeliveryBoys->num_rows;?>
        
          <?php $getAllFoodDeliveryBoys1 = "SELECT * FROM food_delivery_boys WHERE lkp_status_id =0 ORDER BY lkp_status_id, id DESC";
          $getFoodDeliveryBoys1 = $conn->query($getAllFoodDeliveryBoys1);
          $getFoodDeliveryBoysCount1 = $getFoodDeliveryBoys1->num_rows;?>

          <?php $getAllFoodDeliveryBoys2 = "SELECT * FROM food_delivery_boys WHERE lkp_status_id =1 ORDER BY lkp_status_id, id DESC";
          $getFoodDeliveryBoys2 = $conn->query($getAllFoodDeliveryBoys2);
          $getFoodDeliveryBoysCount2 = $getFoodDeliveryBoys2->num_rows;?>

          <a href="food_delivery_boys.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-primary m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Delivery Boys
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-number"><?php echo $getFoodDeliveryBoysCount ?></div>
                Active :  &nbsp;<?php echo $getFoodDeliveryBoysCount1?> &nbsp;&nbsp;&nbsp; In Active :  &nbsp;<?php echo $getFoodDeliveryBoysCount2?>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          <?php $getAdminUsers = "SELECT * FROM admin_users WHERE lkp_admin_service_type_id = 2 ORDER BY lkp_status_id,id DESC";
          $getAdminUsersData = $conn->query($getAdminUsers);
          $getAdminusersCount = $getAdminUsersData->num_rows;?>

          <?php $getAdminUsers1 = "SELECT * FROM admin_users WHERE lkp_status_id =0 AND lkp_admin_service_type_id = 2 ORDER BY lkp_status_id,id DESC";
          $getAdminUsersData1 = $conn->query($getAdminUsers1);
          $getAdminusersCount1 = $getAdminUsersData1->num_rows;?>

          <?php $getAdminUsers2 = "SELECT * FROM admin_users WHERE lkp_status_id =1 AND lkp_admin_service_type_id = 2 ORDER BY lkp_status_id,id DESC";
          $getAdminUsersData2 = $conn->query($getAdminUsers2);
          $getAdminusersCount2 = $getAdminUsersData2->num_rows;?>

          <a href="admin_users.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-warning m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Admin Users</div>
                <div class="wt-number"><?php echo $getAdminusersCount ?></div>
                 Active :  &nbsp;<?php echo $getAdminusersCount1?> &nbsp;&nbsp;&nbsp; In Active :  &nbsp;<?php echo $getAdminusersCount2?>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>

          <?php $getAllFoodOrders = "SELECT * FROM food_orders GROUP BY order_id ORDER BY id DESC";
          $getFoodOrders = $conn->query($getAllFoodOrders);
          $getFoodOrdersCount = $getFoodOrders->num_rows;?>
          <a href="food_orders.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-warning m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Orders</div>
                <div class="wt-number"><?php echo $getFoodOrdersCount ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          <?php $getTodayOrders = "SELECT * FROM food_orders WHERE DATE(`delivery_date`) = CURDATE() AND lkp_order_status_id = 2 AND lkp_payment_status_id = 1 ORDER BY lkp_order_status_id DESC"; 
          $getTodayOrders1 = $conn->query($getTodayOrders); 
          $getRowsCount = $getTodayOrders1->num_rows; ?>
          <a href="food_today_orders.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-danger m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Today Orders</div>
                <div class="wt-number"><?php echo $getRowsCount; ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-shopping-cart-plus"></i>
              </div>
            </div>
          </div>
          </a>
        </div>
        <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-tools">
                </div>
                <h3 class="panel-title">Users</h3>
                <div class="panel-subtitle">Users count based on register device type</div>
              </div>
              <?php $getAndroidUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 2 AND lkp_admin_service_type_id = 2";
              $getAndroidUsers1 = $conn->query($getAndroidUsers);
              $getAndroidUsersCount = $getAndroidUsers1->num_rows; ?>
              <?php $getIosUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 3 AND lkp_admin_service_type_id = 2";
              $getIosUsers1 = $conn->query($getIosUsers);
              $getIosUsersCount = $getIosUsers1->num_rows; ?>
              <?php $getWindowsUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 1 AND lkp_admin_service_type_id = 2";
              $getWindowsUsers1 = $conn->query($getWindowsUsers);
              $getWindowsUsersCount = $getWindowsUsers1->num_rows; ?>
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-primary"></i>
                    </td>
                    <td>Android</td>
                    <td><?php echo $getAndroidUsersCount; ?></td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-warning"></i>
                    </td>
                    <td>iOS</td>
                    <td><?php echo $getIosUsersCount; ?></td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-danger"></i>
                    </td>
                    <td>Web Users</td>
                    <td><?php echo $getWindowsUsersCount; ?></td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="panel-body">
                <div id="donut1" style="height: 215px"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-tools">
                </div>
                <h3 class="panel-title">Top Categories</h3>
                <div class="panel-subtitle"></div>
              </div>
              <div class="panel-body">
                <div class="chart-wrapper">
                  <canvas id="pie-canvas3"  style="height: 345px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-tools">
                </div>
                <h3 class="panel-title">Top sales</h3>
                <div class="panel-subtitle">Lorem ipsum dolor sit amet</div>
              </div>
              <div class="panel-body">
                <div class="chart-wrapper">
                  <canvas id="pie-canvas31" style="height: 215px"></canvas>
                </div>
              </div>
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-primary"></i>
                    </td>
                    <td>Android</td>
                    <td>34</td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-warning"></i>
                    </td>
                    <td>iOS</td>
                    <td>67</td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="zmdi zmdi-circle text-danger"></i>
                    </td>
                    <td>Windows</td>
                    <td>45</td>
                    <td class="text-center">
                    </td>
                    <td class="text-right">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> -->
          </div>
          <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="panel-tools">
                </div>
                <h3 class="panel-title"> Today Orders</h3>
                <div class="panel-subtitle"><?php echo date("Y-m-d");?></div>
              </div>
              <?php $FoodOrders = "SELECT * FROM food_orders WHERE DATE(`created_at`) = CURDATE() AND lkp_order_status_id = 1 AND lkp_payment_status_id!=3 ORDER BY lkp_order_status_id DESC ";
                $getFoodOrderData = $conn->query($FoodOrders); $i=1; ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Created Date</th>
                      <th>Order Id</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($getTotalOrders = $getFoodOrderData->fetch_assoc()) { ?>
                    <tr>
                      <td>
                        <?php echo $i;?>
                      </td>
                      <td><?php echo $getTotalOrders['first_name'];?></td>
                      <td>
                        <?php echo $getTotalOrders['email'];?>
                      </td>
                      <td>
                        <?php echo $getTotalOrders['mobile'];?>
                      </td>
                      <td><?php echo $getTotalOrders['created_at'];?></td>
                      <td><?php echo $getTotalOrders['order_id'];?>
                      </td>
                      <td><a href="food_orders.php"><i class="zmdi zmdi-eye zmdi-hc-fw"  class=""></i></a>
                      </td>
                      <td>
                      </td>
                    </tr>
                    <?php $i++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
              
          </div>
        <!-- <div class="col-md-6 m-b-30">
          <h4 class="m-t-0 m-b-30">Pie chart</h4>
          <div id="pie" style="height: 300px"></div>
        </div> -->


      </div>

        <?php include_once 'admin_includes/footer.php'; ?>
    
    
    <script type="text/javascript">
    "use strict";!function(a){new Chart(a("#infoblock-chart-1"),{type:"line",data:{labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset",data:[45,40,30,20,25,35,50],fill:!0,backgroundColor:"#e53935",borderColor:"#e53935",borderWidth:2,borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#e53935",pointBackgroundColor:"#fff",pointBorderWidth:2,pointHoverRadius:4,pointHoverBackgroundColor:"#e53935",pointHoverBorderColor:"#fff",pointHoverBorderWidth:2,pointRadius:[0,4,4,4,4,4,0],pointHitRadius:10,spanGaps:!1}]},options:{scales:{xAxes:[{display:!1}],yAxes:[{display:!1,ticks:{min:0,max:60}}]},legend:{display:!1}}}),new Chart(a("#infoblock-chart-2"),{type:"line",data:{labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset",data:[30,22,18,25,40,55,60],fill:!0,backgroundColor:"#7d57c1",borderColor:"#7d57c1",borderWidth:2,borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#7d57c1",pointBackgroundColor:"#fff",pointBorderWidth:2,pointHoverRadius:4,pointHoverBackgroundColor:"#7d57c1",pointHoverBorderColor:"#fff",pointHoverBorderWidth:2,pointRadius:[0,4,4,4,4,4,0],pointHitRadius:10,spanGaps:!1}]},options:{scales:{xAxes:[{display:!1}],yAxes:[{display:!1,ticks:{min:0,max:60}}]},legend:{display:!1}}}),a('[data-chart="peity"]').each(function(){var b=a(this).attr("data-type");a(this).peity(b)}),Morris.Donut({element:"donut1",data:[{label:"Android",value:<?php echo $getAndroidUsersCount; ?>},{label:"iOS",value:<?php echo $getIosUsersCount; ?>},{label:"WebUsers",value:<?php echo $getWindowsUsersCount; ?>}],resize:!0,colors:["#1d87e4","#faa800","#e53935"]}),a("#vector-map").vectorMap({map:"world_en",backgroundColor:null,borderColor:null,borderOpacity:.5,borderWidth:1,color:"#1d87e4",enableZoom:!0,hoverColor:"#1d87e4",hoverOpacity:.7,normalizeFunction:"linear",selectedColor:"#faa800",selectedRegions:["au","ca","de","br","in"],showTooltip:!0});for(var b=[],c=0;c<=6;c+=1)b.push([c,parseInt(20*Math.random())]);for(var d=[],e=0;e<=6;e+=1)d.push([e,parseInt(20*Math.random())]);var f=[{label:"Data One",data:b,bars:{order:1}},{label:"Data Two",data:d,bars:{order:2}}];a.plot(a("#chart-bar"),f,{bars:{show:!0,barWidth:.2,fill:1},series:{stack:0},grid:{color:"#aaa",hoverable:!0,borderWidth:0,labelMargin:5,backgroundColor:"#fff"},legend:{show:!1},colors:["#faa800","#34a853"],tooltip:!0,tooltipOpts:{content:"%s : %y.0",shifts:{x:-30,y:-50}}}),a(function(){function b(){for(d.length>0&&(d=d.slice(1));d.length<e;){var a=d.length>0?d[d.length-1]:50,b=a+10*Math.random()-5;b<5?b=5:b>95&&(b=95),d.push(b)}for(var c=[],f=0;f<d.length;++f)c.push([f,d[f]]);return c}function c(){g.setData([b()]),g.draw(),setTimeout(c,f)}var d=[],e=300,f=60,g=a.plot("#realtime",[b()],{series:{shadowSize:0},yaxis:{min:0,max:100},xaxis:{min:0,max:300},colors:["#7d57c1"],grid:{color:"#aaa",hoverable:!0,borderWidth:0,backgroundColor:"#fff"},tooltip:!0,tooltipOpts:{content:"Y: %y",defaultTheme:!1}});c()})}(jQuery);

    </script>
    <script src="js/charts-flot.min.js"></script>
<script>
    function createChart(id, type, options) {
      var data = {
        labels: [ <?php $getOrders =  $conn->query("SELECT * FROM food_orders GROUP BY category_id");
          while ($getOrdersData = $getOrders->fetch_assoc()) {
            $category_id1 = $getOrdersData['category_id']; 
            $getCategoriesNames = $conn->query("SELECT * FROM food_category WHERE id = '$category_id1'");
            $getCategoriesNames1 = $getCategoriesNames->fetch_assoc();
            echo "'".$getCategoriesNames1['category_name'] . "'".','; } ?> ],
        datasets: [
          {
            label: 'My First dataset',
            data: [<?php $getOrders1 =  $conn->query("SELECT * FROM food_orders GROUP BY category_id");
                        while ($getOrdersCount = $getOrders1->fetch_assoc()) {
                          $category_id = $getOrdersCount['category_id']; 
                          $getCategories1 = $conn->query("SELECT * FROM food_orders WHERE category_id = '$category_id'");
                          $noRows = $getCategories1->num_rows;
                          echo $noRows.','; }
                          ?>],
            backgroundColor: [
              '#4D4D4D',
              '#5DA5DA',
              '#FAA43A',
              '#60BD68',
              '#F17CB0',
              '#B2912F',
              '#36A2EB',
              '#DECF3F'
            ]
          }
        ]
      };

      new Chart(document.getElementById(id), {
        type: type,
        data: data,
        options: options
      });
    }

    ['pie'].forEach(function (type) {
      createChart(type + '-canvas3', type, {
        responsive: true,
        maintainAspectRatio: false,
        pieceLabel: {
          render: 'percentage',
        }
      });
    });
  </script>

     
    
     