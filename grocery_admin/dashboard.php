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
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="widget widget-tile-1 m-b-30">
              <div class="p-t-20 p-x-20">
                <div class="wt-title">New users
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-text">Updated today at 14:57</div>
                <div class="wt-number">175</div>
              </div>
              <canvas id="tile-chart-1"></canvas>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="widget widget-tile-1 m-b-30">
              <div class="p-t-20 p-x-20">
                <div class="wt-title">Sales
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-text">+17% from previous period</div>
                <div class="wt-number">$ 47,855</div>
              </div>
              <canvas id="tile-chart-2"></canvas>
              <div class="wt-icon">
                <i class="zmdi zmdi-shopping-basket"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="widget widget-tile-1 m-b-30">
              <div class="p-t-20 p-x-20">
                <div class="wt-title">Subscriptions
                  <span class="t-caret text-danger">
                    <i class="zmdi zmdi-caret-down"></i>
                  </span>
                </div>
                <div class="wt-text">Calculated in last 7 days</div>
                <div class="wt-number">693</div>
              </div>
              <canvas id="tile-chart-3"></canvas>
              <div class="wt-icon">
                <i class="zmdi zmdi-email-open text-success"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="widget widget-tile-1 m-b-30">
              <div class="p-t-20 p-x-20">
                <div class="wt-title">CPU usage
                  <span class="t-caret text-success">
                    <i class="zmdi zmdi-caret-up"></i>
                  </span>
                </div>
                <div class="wt-text">Updated: 09:26 AM</div>
                <div class="wt-number">75%</div>
              </div>
              <canvas id="tile-chart-4"></canvas>
            </div>
          </div>
        </div>
        <div class="widget widget-tabs">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active">
              <a href="#tab-1" data-toggle="tab" role="tab">Recent Sales</a>
            </li>
            <li class="nav-item">
              <a href="#">Traffic Source</a>
            </li>
            <li class="nav-item">
              <a href="#">Activity Log</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-1" role="tabpanel">
              <div class="p-a-20">
                <div id="multiple" style="height: 350px"></div>
              </div>
              <div class="p-a-20 wt-footer">
                <div class="row text-center">
                  <div class="col-sm-3 col-xs-6">
                    <h4 class="m-b-0">$ 89.34</h4>
                    <p class="text-muted">Daily Sales</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                    <h4 class="m-b-0">$ 498.00</h4>
                    <p class="text-muted">Weekly Sales</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                    <h4 class="m-b-0">$ 34,903</h4>
                    <p class="text-muted">Monthly Sales</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                    <h4 class="m-b-0">$ 98,343.49</h4>
                    <p class="text-muted">Yearly Sales</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="panel-tools">
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-refresh"></i>
                  </a>
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </div>
                <h3 class="panel-title">Tickets</h3>
                <div class="panel-subtitle">+9 today</div>
              </div>
              <div class="panel-body">
                <div class="text-center m-b-30">
                  <div class="btn-group btn-group-sm" data-toggle="buttons">
                    <label class="btn btn-default active">
                      <input type="radio" name="buttonRadios" id="buttonRadios1" autocomplete="off" checked="checked"> Complete
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="buttonRadios" id="buttonRadios2" autocomplete="off"> Open
                    </label>
                  </div>
                </div>
                <div id="chart-line" style="height: 218px"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="panel-tools">
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-refresh"></i>
                  </a>
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </div>
                <h3 class="panel-title">Conversions</h3>
                <div class="panel-subtitle">+36 today</div>
              </div>
              <div class="panel-body">
                <div class="text-center m-b-30">
                  <div class="btn-group btn-group-sm" data-toggle="buttons">
                    <label class="btn btn-default active">
                      <input type="radio" name="buttonRadios" id="buttonRadios1" autocomplete="off" checked="checked"> Corporate
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="buttonRadios" id="buttonRadios2" autocomplete="off"> Retail
                    </label>
                  </div>
                </div>
                <div id="chart-donut" style="height: 218px"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-tools">
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-refresh"></i>
                  </a>
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </div>
                <h3 class="panel-title">Latest activity</h3>
                <div class="panel-subtitle">Lorem ipsum dolor sit amet</div>
              </div>
              <div class="panel-body">
                <p>Jonathan Mel
                  <span class="pull-right text-muted">80%</span>
                </p>
                <div class="progress progress-xs m-b-20">
                  <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (success)</span>
                  </div>
                </div>
                <p>Landon Graham
                  <span class="pull-right text-muted">57%</span>
                </p>
                <div class="progress progress-xs m-b-20">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                    <span class="sr-only">57% Complete (success)</span>
                  </div>
                </div>
                <p>Ron Carran
                  <span class="pull-right text-muted">60%</span>
                </p>
                <div class="progress progress-xs m-b-20">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (success)</span>
                  </div>
                </div>
                <p>Vance Osborn
                  <span class="pull-right text-muted">23%</span>
                </p>
                <div class="progress progress-xs m-b-20">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%">
                    <span class="sr-only">23% Complete (success)</span>
                  </div>
                </div>
                <p>Wolfe Stevie
                  <span class="pull-right text-muted">45%</span>
                </p>
                <div class="progress progress-xs m-b-20">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                    <span class="sr-only">45% Complete (success)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="panel-tools">
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-refresh"></i>
                  </a>
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </div>
                <h3 class="panel-title">Recent purchases</h3>
                <div class="panel-subtitle">+23% from previous period</div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Country</th>
                      <th>Users</th>
                      <th>Clicks</th>
                      <th>Sales</th>
                      <th style="width: 5%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <span class="flag-icon flag-icon-us"></span>
                      </td>
                      <td>USA</td>
                      <td>30%
                        <span class="text-success">
                          <i class="zmdi zmdi-arrow-right-top"></i>
                        </span>
                      </td>
                      <td>930</td>
                      <td>34</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="flag-icon flag-icon-gb"></span>
                      </td>
                      <td>Germany</td>
                      <td>25%
                        <span class="text-success">
                          <i class="zmdi zmdi-arrow-right-top"></i>
                        </span>
                      </td>
                      <td>1023</td>
                      <td>26</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr class="warning">
                      <td>
                        <span class="flag-icon flag-icon-us"></span>
                      </td>
                      <td>USA</td>
                      <td>17%
                        <span class="text-danger">
                          <i class="zmdi zmdi-arrow-left-bottom"></i>
                        </span>
                      </td>
                      <td>1560</td>
                      <td>87</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="flag-icon flag-icon-fr"></span>
                      </td>
                      <td>France</td>
                      <td>36%
                        <span class="text-success">
                          <i class="zmdi zmdi-arrow-right-top"></i>
                        </span>
                      </td>
                      <td>2500</td>
                      <td>148</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr class="warning">
                      <td>
                        <span class="flag-icon flag-icon-pl"></span>
                      </td>
                      <td>Poland</td>
                      <td>12%
                        <span class="text-danger">
                          <i class="zmdi zmdi-arrow-left-bottom"></i>
                        </span>
                      </td>
                      <td>1460</td>
                      <td>75</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="flag-icon flag-icon-no"></span>
                      </td>
                      <td>Norway</td>
                      <td>24%
                        <span class="text-success">
                          <i class="zmdi zmdi-arrow-right-top"></i>
                        </span>
                      </td>
                      <td>987</td>
                      <td>14</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="flag-icon flag-icon-ru"></span>
                      </td>
                      <td>Russia</td>
                      <td>33%
                        <span class="text-success">
                          <i class="zmdi zmdi-arrow-right-top"></i>
                        </span>
                      </td>
                      <td>1750</td>
                      <td>77</td>
                      <td class="actions">
                        <a href="#">
                          <i class="zmdi zmdi-more"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="panel-tools">
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-download"></i>
                  </a>
                  <a href="#" class="tools-icon">
                    <i class="zmdi zmdi-close"></i>
                  </a>
                </div>
                <h3 class="panel-title">Recent orders</h3>
                <div class="panel-subtitle">+17% from previous period</div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 32px"></th>
                      <th style="width: 32px"></th>
                      <th>Name</th>
                      <th>Dynamics</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom" checked="checked">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/1.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Airi Satou</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$162,700</td>
                      <td>
                        <span class="label label-outline-success">Active</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/2.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Angelica Ramos</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$98,300</td>
                      <td>
                        <span class="label label-outline-info">Expired</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom" checked="checked">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/3.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Angelica Ramos</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$98,300</td>
                      <td>
                        <span class="label label-outline-info">Expired</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom" checked="checked">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/4.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Ashton Cox</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$47,000</td>
                      <td>
                        <span class="label label-outline-info">Expired</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/5.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Bradley Greer</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$250,600</td>
                      <td>
                        <span class="label label-outline-success">Active</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <label class="custom-control custom-control-primary custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="custom">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </td>
                      <td>
                        <img class="img-circle" src="img/avatars/6.jpg" alt="" width="32" height="32">
                      </td>
                      <td>Brenden Wagner</td>
                      <td>
                        <span data-chart="peity" data-type="line">5,3,9,6,5,9,7,3,5,2</span>
                      </td>
                      <td>$125,000</td>
                      <td>
                        <span class="label label-outline-success">Active</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-footer">
        2017 © Cosmos
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/dashboard-3.min.js"></script>
  </body>

<!-- Mirrored from big-bang-studio.com/cosmos/dashboard-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Aug 2017 10:13:38 GMT -->
</html>