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
      <?php $getUsers = "SELECT * FROM users WHERE lkp_admin_service_type_id = 3 ORDER BY lkp_status_id, id DESC";
          $getUsersData = $conn->query($getUsers);
          $getUsersCount = $getUsersData->num_rows;?>

          <?php $getUsers1 = "SELECT * FROM users WHERE lkp_status_id =0 AND lkp_admin_service_type_id = 3 ORDER BY lkp_status_id, id DESC";
          $getUsersData1 = $conn->query($getUsers1);
          $getUsersCount1 = $getUsersData1->num_rows;?>

          <?php $getUsers2 = "SELECT * FROM users WHERE lkp_status_id =1 AND lkp_admin_service_type_id = 3 ORDER BY lkp_status_id, id DESC";
          $getUsersData2 = $conn->query($getUsers2);
          $getUsersCount2 = $getUsersData2->num_rows;?>
      <div class="site-content">

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
          <?php $getAllGroceryDeliveryBoys = "SELECT * FROM grocery_delivery_boys ORDER BY lkp_status_id, id DESC";
          $getGroceryDeliveryBoys = $conn->query($getAllGroceryDeliveryBoys);
          $getGroceryDeliveryBoysCount = $getGroceryDeliveryBoys->num_rows;?>
        
          <?php $getAllGroceryDeliveryBoys1 = "SELECT * FROM grocery_delivery_boys WHERE lkp_status_id =0 ORDER BY lkp_status_id, id DESC";
          $getGroceryDeliveryBoys1 = $conn->query($getAllGroceryDeliveryBoys1);
          $getGroceryDeliveryBoysCount1 = $getGroceryDeliveryBoys1->num_rows;?>

          <?php $getAllGroceryDeliveryBoys2 = "SELECT * FROM grocery_delivery_boys WHERE lkp_status_id =1 ORDER BY lkp_status_id, id DESC";
          $getGroceryDeliveryBoys2 = $conn->query($getAllGroceryDeliveryBoys2);
          $getGroceryDeliveryBoysCount2 = $getGroceryDeliveryBoys2->num_rows;?>
          <a href="delivery_boys.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-primary m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Delivery Boys
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-number"><?php echo $getGroceryDeliveryBoysCount ?></div>
                Active :  &nbsp;<?php echo $getGroceryDeliveryBoysCount1?> &nbsp;&nbsp;&nbsp; In Active :  &nbsp;<?php echo $getGroceryDeliveryBoysCount2?>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a>
          <?php $getAdminUsers = "SELECT * FROM admin_users WHERE lkp_admin_service_type_id = 3 ORDER BY lkp_status_id,id DESC";
          $getAdminUsersData = $conn->query($getAdminUsers);
          $getAdminusersCount = $getAdminUsersData->num_rows;?>

          <?php $getAdminUsers1 = "SELECT * FROM admin_users WHERE lkp_status_id =0 AND lkp_admin_service_type_id = 3 ORDER BY lkp_status_id,id DESC";
          $getAdminUsersData1 = $conn->query($getAdminUsers1);
          $getAdminusersCount1 = $getAdminUsersData1->num_rows;?>

          <?php $getAdminUsers2 = "SELECT * FROM admin_users WHERE lkp_status_id =1 AND lkp_admin_service_type_id = 3 ORDER BY lkp_status_id,id DESC";
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
          </div>

          <div class="row">
          <?php $getAllGroceryOrders = "SELECT * FROM grocery_orders WHERE lkp_payment_status_id != 3 AND lkp_order_status_id != 3 GROUP BY order_id ORDER BY id DESC";
          $getGroceryOrders = $conn->query($getAllGroceryOrders);
          $getGroceryOrdersCount = $getGroceryOrders->num_rows;?>
          <a href="view_orders.php">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-warning m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Orders</div>
                <div class="wt-number"><?php echo $getGroceryOrdersCount ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
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
              <?php $getAndroidUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 2 AND lkp_admin_service_type_id = 3";
              $getAndroidUsers1 = $conn->query($getAndroidUsers);
              $getAndroidUsersCount = $getAndroidUsers1->num_rows; ?>
              <?php $getIosUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 3 AND lkp_admin_service_type_id = 3";
              $getIosUsers1 = $conn->query($getIosUsers);
              $getIosUsersCount = $getIosUsers1->num_rows; ?>
              <?php $getWindowsUsers = "SELECT * FROM users WHERE lkp_register_device_type_id = 1 AND lkp_admin_service_type_id = 3";
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
          
          </div>
        
  
      </div>
      <?php include_once 'footer.php'; ?>
    
    <script src="js/dashboard-3.min.js"></script>
    <script type="text/javascript">
    "use strict";!function(a){new Chart(a("#infoblock-chart-1"),{type:"line",data:{labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset",data:[45,40,30,20,25,35,50],fill:!0,backgroundColor:"#e53935",borderColor:"#e53935",borderWidth:2,borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#e53935",pointBackgroundColor:"#fff",pointBorderWidth:2,pointHoverRadius:4,pointHoverBackgroundColor:"#e53935",pointHoverBorderColor:"#fff",pointHoverBorderWidth:2,pointRadius:[0,4,4,4,4,4,0],pointHitRadius:10,spanGaps:!1}]},options:{scales:{xAxes:[{display:!1}],yAxes:[{display:!1,ticks:{min:0,max:60}}]},legend:{display:!1}}}),new Chart(a("#infoblock-chart-2"),{type:"line",data:{labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset",data:[30,22,18,25,40,55,60],fill:!0,backgroundColor:"#7d57c1",borderColor:"#7d57c1",borderWidth:2,borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#7d57c1",pointBackgroundColor:"#fff",pointBorderWidth:2,pointHoverRadius:4,pointHoverBackgroundColor:"#7d57c1",pointHoverBorderColor:"#fff",pointHoverBorderWidth:2,pointRadius:[0,4,4,4,4,4,0],pointHitRadius:10,spanGaps:!1}]},options:{scales:{xAxes:[{display:!1}],yAxes:[{display:!1,ticks:{min:0,max:60}}]},legend:{display:!1}}}),a('[data-chart="peity"]').each(function(){var b=a(this).attr("data-type");a(this).peity(b)}),Morris.Donut({element:"donut1",data:[{label:"Android",value:<?php echo $getAndroidUsersCount; ?>},{label:"iOS",value:<?php echo $getIosUsersCount; ?>},{label:"WebUsers",value:<?php echo $getWindowsUsersCount; ?>}],resize:!0,colors:["#1d87e4","#faa800","#e53935"]}),a("#vector-map").vectorMap({map:"world_en",backgroundColor:null,borderColor:null,borderOpacity:.5,borderWidth:1,color:"#1d87e4",enableZoom:!0,hoverColor:"#1d87e4",hoverOpacity:.7,normalizeFunction:"linear",selectedColor:"#faa800",selectedRegions:["au","ca","de","br","in"],showTooltip:!0});for(var b=[],c=0;c<=6;c+=1)b.push([c,parseInt(20*Math.random())]);for(var d=[],e=0;e<=6;e+=1)d.push([e,parseInt(20*Math.random())]);var f=[{label:"Data One",data:b,bars:{order:1}},{label:"Data Two",data:d,bars:{order:2}}];a.plot(a("#chart-bar"),f,{bars:{show:!0,barWidth:.2,fill:1},series:{stack:0},grid:{color:"#aaa",hoverable:!0,borderWidth:0,labelMargin:5,backgroundColor:"#fff"},legend:{show:!1},colors:["#faa800","#34a853"],tooltip:!0,tooltipOpts:{content:"%s : %y.0",shifts:{x:-30,y:-50}}}),a(function(){function b(){for(d.length>0&&(d=d.slice(1));d.length<e;){var a=d.length>0?d[d.length-1]:50,b=a+10*Math.random()-5;b<5?b=5:b>95&&(b=95),d.push(b)}for(var c=[],f=0;f<d.length;++f)c.push([f,d[f]]);return c}function c(){g.setData([b()]),g.draw(),setTimeout(c,f)}var d=[],e=300,f=60,g=a.plot("#realtime",[b()],{series:{shadowSize:0},yaxis:{min:0,max:100},xaxis:{min:0,max:300},colors:["#7d57c1"],grid:{color:"#aaa",hoverable:!0,borderWidth:0,backgroundColor:"#fff"},tooltip:!0,tooltipOpts:{content:"Y: %y",defaultTheme:!1}});c()})}(jQuery);

    </script>

    <script src="js/charts-flot.min.js"></script>
    <script>
    function createChart(id, type, options) {
      var data = {
        labels: [ <?php $getOrders =  $conn->query("SELECT * FROM grocery_orders GROUP BY category_id");
          while ($getOrdersData = $getOrders->fetch_assoc()) {
            $category_id1 = $getOrdersData['category_id']; 
            $getCategoriesNames = $conn->query("SELECT * FROM grocery_category WHERE id = '$category_id1'");
            $getCategoriesNames1 = $getCategoriesNames->fetch_assoc();
            echo "'".$getCategoriesNames1['category_name'] . "'".','; } ?> ],
        datasets: [
          {
            label: 'My First dataset',
            data: [<?php $getOrders1 =  $conn->query("SELECT * FROM grocery_orders GROUP BY category_id");
                        while ($getOrdersCount = $getOrders1->fetch_assoc()) {
                          $category_id = $getOrdersCount['category_id']; 
                          $getCategories1 = $conn->query("SELECT * FROM grocery_orders WHERE category_id = '$category_id'");
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
  </body>

<!-- Mirrored from big-bang-studio.com/cosmos/dashboard-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2017 10:13:38 GMT -->
</html>