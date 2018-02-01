<?php 
error_reporting(1);
ob_start();
include_once('../admin_includes/config.php');
include_once('../admin_includes/common_functions.php');

if(!isset($_SESSION['grocery_admin_user_id'])) {
  header("Location: logout.php");
  exit;
}

?>
<?php $getSiteSettings = getAllDataWhere('grocery_site_settings','id',1); 
$getSiteSettingsData = $getSiteSettings->fetch_assoc();
?>
<nav class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand" href="">
            <img src="<?php echo $base_url . 'uploads/logo/'.$getSiteSettingsData['logo'] ?>" alt="<?php echo $getSiteSettingsData['admin_title'];?>" height="45">
            <!-- <span><?php echo $getSiteSettingsData['admin_title'];?></span> -->
          </a>
          <button class="navbar-toggler left-sidebar-toggle pull-left visible-xs" type="button">
            <span class="hamburger"></span>
          </button>
          <button class="navbar-toggler right-sidebar-toggle pull-right visible-xs-block" type="button">
            <i class="zmdi zmdi-long-arrow-left"></i>
            <div class="dot bg-danger"></div>
          </button>
          <button class="navbar-toggler pull-right visible-xs-block" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="more"></span>
          </button>
        </div>
        <div class="navbar-collapsible">
          <div id="navbar" class="navbar-collapse collapse">
            <button class="navbar-toggler left-sidebar-collapse pull-left hidden-xs" type="button">
              <span class="hamburger"></span>
            </button>
            <button class="navbar-toggler right-sidebar-toggle pull-right hidden-xs" type="button">
              <i class="zmdi zmdi-long-arrow-left"></i>
              <div class="dot bg-danger"></div>
            </button>
            <ul class="nav navbar-nav">
              <li class="visible-xs-block">
                <div class="nav-avatar">
                  <img class="img-circle" src="img/avatars/1.jpg" alt="" width="48" height="48">
                </div>
                <h4 class="navbar-text text-center">Welcome, Jon Snow!</h4>
              </li>
            </ul>
            <form class="navbar-form navbar-left">
              <div class="navbar-search-group">
                <input type="text" class="form-control" placeholder="Search">
                <button type="submit" class="btn btn-default">
                  <i class="zmdi zmdi-search"></i>
                </button>
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav-table dropdown visible-xs-block">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="nav-cell nav-icon">
                    <i class="zmdi zmdi-account-o"></i>
                  </span>
                  <span class="hidden-md-up m-l-15">Account</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Settings</a></li>
                  <li><a href="#">Help</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Logout</a></li>
                </ul>
              </li>
             
            
              <li class="nav-table dropdown hidden-sm-down">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="nav-cell p-r-10">
                    <img class="img-circle" src="img/avatars/1.jpg" alt="" width="32" height="32">
                  </span>
                  <span class="nav-cell"><?php echo $_SESSION['grocery_admin_user_name']; ?>
                    <span class="caret"></span>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- <li>
                    <a href="#">
                      <i class="zmdi zmdi-account-o m-r-10"></i> Profile</a>
                  </li> -->
                  <!-- <li>
                    <a href="#">
                      <i class="zmdi zmdi-settings m-r-10"></i> Settings</a>
                  </li>-->
                  <li>
                    <a href="change_password.php">
                      <i class="zmdi zmdi-power m-r-10"></i>Change Password</a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="logout.php">
                      <i class="zmdi zmdi-power m-r-10"></i> Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="site-main">
    <?php include_once 'admin_includes/side_navigation.php'; ?>
    <?php if(isset($_GET['msg']) && $_GET['msg']=='success') { ?>
    <div class="col-sm-6 col-md-offset-5" style="margin-left:32.667% !important; margin-top:7px;" id="set_valid_msg">
      <div class="alert alert-success alert-icon-bg alert-dismissable" role="alert" style="margin-bottom:-7px;">
        <div class="alert-icon">
          <i class="zmdi zmdi-check"></i>
        </div>
        <div class="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
              <i class="zmdi zmdi-close"></i>
            </span>
          </button>
          <strong>Well done!</strong> Your data updated successfully  .
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <?php } elseif(isset($_GET['msg']) && $_GET['msg']=='fail') { ?>
    <div class="col-sm-6 col-md-offset-5" style="margin-left:32.667% !important; margin-top:7px;" id="set_valid_msg">
      <div class="alert alert-danger alert-icon-bg alert-dismissable" role="alert" style="margin-bottom:-7px;">
        <div class="alert-icon">
          <i class="zmdi zmdi-check"></i>
        </div>
        <div class="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
              <i class="zmdi zmdi-close"></i>
            </span>
          </button>
          <strong>Oops!</strong> Your data updation failed.
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  <?php } else {  ?>
  <div class="clearfix"></div>
  <?php } ?>
      </nav>
