<?php
if(isset($sort_this))
{
require_once('sort_this_code.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <link rel="icon" href="<?= base_url() ?>dist/img/llama_ico.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <!--link rel="stylesheet" href="<?=base_url()?>bower_components/morris.js/morris.css"-->  
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


  <!-- Word Press Button -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/wp-buttons/button.css">

  <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php /*
    <!-- AJAX DATATABLE !!!! -->

    <link rel="stylesheet" href="http://localhost/projects/WORKING%20AJAX%20DATATABLE/media/css/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/projects/WORKING%20AJAX%20DATATABLE/media/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" href="http://localhost/projects/WORKING%20AJAX%20DATATABLE/media/css/dataTables.bootstrap.min.css">

    <!-- END AJAX -->
*/ ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
<!-- Font Not Found
  <link rel="stylesheet" href="<?=base_url()?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
-->

<style>
  /*
  .form_fix{
    height:34px !important;
  }
  */
  
  .tooltip-inner {
    color: #000;
    background-color: #D7CB10;
    padding-top: 10px;
    padding-bottom: 10px;
    text-align:left;
    max-width: 350px;
    /* If max-width does not work, try using width instead */
    width: 350px; 
  }
  .dotted_underline:hover{    
  text-decoration-line: underline;
  text-decoration-style: dashed;
  cursor: default;
  }
  .required_field{
  font-weight: bold;
  background-color: #efbaba;
  }
  .required{
  font-size: 15pt;
  color: #007cff;
  }
  .required:after{
  content: "*";
  }

  .btn_rendez{
    width:81.25px !important;
  }
  .btn-secondary{
    color: #000;
  }
  *{
    word-wrap:break-word;
  }
  body{    
    overflow-y: scroll;
    margin-bottom:-199px;
  }  
  html, body{    
    height:-webkit-fill-available !important;
  }
  .affix {
      position: static;
      width: 100%;
      z-index: 9999 !important;
  }
  .pointer{
    cursor:pointer;
  }
  #pnProductNavContents .pn-ProductNav_Link{
    background-color: #FFFFFF !important;
  }
  .main-footer {
    display: inline-flex;
    width: -webkit-fill-available;
  }
  .wrapper{
    overflow-y: hidden;
    /*background-color: #ecf0f5 !important;*/
    background-color: #ffffff !important;
  }
  .content-wrapper{
    height: auto;
    margin-bottom: 10px;
    /*margin-bottom: 250px;*/
    min-height: -webkit-fill-available !important;

    background-color: #ffffff;
  }

  .box{
    border: 1px solid #d2d6de;
  }

  .btn:hover, .btn:focus{
    color: white;
  }
  .btn-box-tool:hover, .btn-box-tool:focus{
    color: #444;
  }



  a.disabled {
     pointer-events: none;
     cursor: default;
  }

  .main-header .navbar {
    color: #fff !important;
    background-color: #3C8DBC !important;
  }
  .main-header .logo {
    color: #fff !important;
    background-color: #367FA9 !important;
  }
  .main-header .navbar .sidebar-toggle{    
    color: #fff !important;
    border-right: 0px !important;
  }
  .main-header .navbar .nav>li>a {
    color: #fff !important;
    border-right: 0px !important;
  }
  .main-header .navbar .navbar-custom-menu .navbar-nav>li>a, .main-header .navbar .navbar-right>li>a {
    border-left: 0px !important;
    border-right-width: 0;
  }
  .main-header .navbar .nav>li>a:hover, .main-header .navbar .nav>li>a:focus{
    background-color: #367FA9 !important;
  }
  .main-header .navbar .sidebar-toggle:hover{    
    background-color: #367FA9 !important;
  }
  .main-header .navbar .sidebar-toggle:focus{
    background-color: #3C8DBC !important;
  }
  .skin-black .main-header>.logo {
    border-right: 0px !important;
  }
  .skin-blue .main-header li.user-header {
    background-color: #367FA9 !important;
  }

@media only screen and (max-width: 768px) {
  .affix {
    position: fixed;
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }
}
@media only screen and (max-width: 800px) {
  h1{
    font-size:20pt;
    margin-left:10px;
  }
  .form-control{
    height: 35px;
    font-size: 15px !important;
  }
  .modal-body br{
    display: none;
    padding: 15px 0 15px 0 !important;
  }

  /* Force table to not be like tables anymore */
  table, 
  thead, 
  tfoot, 
  tbody, 
  th, 
  td, 
  tr { 
    display: block !important; 
  } 
 
  /* Hide table headers (but not display: none !important;, for accessibility) */
  thead tr { 
    position: absolute !important;
    top: -9999px !important;
    left: -9999px !important;
  }
 
  tr { border: 1px solid #ccc !important; }
 
  tbody td { 
    /* Behave  like a "row" */
    border: none !important;
    border-bottom: 1px solid #eee !important; 
    position: relative !important;
    padding-left: 50% !important; 
    white-space: normal !important;
    text-align:left !important;
  }
 
  tbody td:before { 
    /* Now like a table header */
    position: absolute !important;
    /* Top/left values mimic padding */
    top: 6px !important;
    left: 6px !important;
    width: 45% !important; 
    padding-right: 10px !important; 
    white-space: break-word !important; /*nowrap*/
    text-align:left !important;
    font-weight: bold !important;
  }
 
  /*
  Label the data
  */
  tbody td:before { content: attr(data-title) !important; }

/*
  #calendar table *{
  display: initial !important;
  position: initial !important;
  border: none !important;
  width: initial !important;
  padding-left: initial !important;

  border: none !important;
  border-bottom: 0 !important; 
  position: initial; !important;
  padding-left: 0 !important; 
  white-space: normal !important;
  text-align:initial !important;
  }

  #calendar table{ display: table !important;}
  #calendar thead{ display: table-header-group !important;}
  #calendar tfoot{ display: table-footer-group !important;}
  #calendar tbody{ display: table-column-group !important;}
  #calendar tr{ display: table-row !important;}

  #calendar tbody td:before {    
  padding: 0 !important;
  content: none !important;
  width: initial !important;
  }
*/

}
  
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>/dashboard/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>L</b>2</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Kossuth</b>könyvtár 2.0</span>
    </a>
    <!-- Header Navbar: style can be found in header.less (navbar-static-top)-->
    <nav class="navbar" data-spy="affix" data-offset-top="110">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php /* ?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">                  
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url()?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url()?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url()?>dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url()?>dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->          
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <?php */ ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile?>" class="user-image special-img" alt="User Image">
              <span class="hidden-xs"><?= $username ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile?>" class="img-circle special-img" alt="User Image">

                <p>
                  <?= $lastname . ' ' . $firstname ?>
                  <small>Regisztrálva: <?= $reg_date ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Előzmények</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div-->

                <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="<?= base_url() ?>bibliografiak/hosszabbit">Kölcsönzések</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="<?= base_url() ?>bibliografiak/view/kosar_tartalma">Előfoglalások</a>
                  </div>
                </div>

                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url()?>fiok/profil/admin" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url()?>fiok/logout" class="btn btn-default btn-flat">Kilépés</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

          <!--BEÁLLÍTÁSOK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->

          <!--li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() . 'dist/img/avatar/png/' . $profile?>" class="img-circle special-img" alt="User Image">          
          <!--img src="<?=base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"-->
        </div>
        <div class="pull-left info">
          <p><?= $lastname." ".$firstname ?></p>
          <p class="small"><i><?= $username ?></i></p>
          <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
        </div>
      </div><br/>
      <!-- search form -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>FIÓK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>fiok/logout"><i class="fa fa-sign-out"></i> <span>Kijelentkezés</span></a></li>
            <li><a href="<?=base_url()?>feltetelek" target="_blank"><i class="fa fa-book"></i> <span>Feltételek</span></a></li>
            <!--li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-question-circle"></i> <span>Segítség</span></a></li-->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>FORGALOM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>dashboard/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <!--li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-search"></i> <span>Tagkereső</span></a></li>
            <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-check-circle"></i> <span>Becsekkolás</span></a></li-->
            <li><a href="<?=base_url()?>tagok/manage/20"><i class="fa fa-user-plus"></i> <span>Könyvtári tagok</span></a></li>
            <li><a href="<?=base_url()?>felhasznalok/manage/20"><i class="fa fa-user-plus"></i> <span>Felhasználók</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i> <span>KATALOGIZÁLÁS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="<?=base_url()?>bibliografiak/admin_search"><i class="fa fa-search"></i> <span>Keresés</span></a></li>
           <li><a href="<?=base_url()?>bibliografiak/manage/20"><i class="fa fa-book"></i> <span>Bibliográfiák</span></a></li>
             <li><a href="<?=base_url()?>konyvtarak/manage/20"><i class="fa fa-bank"></i> <span>Könyvtárak</span></a></li> 
             <li><a href="<?=base_url()?>z3950/manage/20"><i class="fa fa-database"></i> <span>z3950</span></a></li>             
<?php /* ?>
             <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-file-o"></i> <span>Kölcsönzői jogok</span></a></li>
             <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-file-o"></i> <span>Könyvtárbeállítások</span></a></li>
<?php */ ?>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i> <span>RÉSZLET ADATOK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>termek/manage/20"><i class="fa fa-pencil"></i> <span>Termek</span></a></li>
             <li><a href="<?=base_url()?>szerzok/manage/20"><i class="fa fa-pencil"></i> <span>Szerzők</span></a></li>
             <li><a href="<?=base_url()?>kiadok/manage/20"><i class="fa fa-pencil"></i> <span>Kiadók</span></a></li>
             <li><a href="<?=base_url()?>nyelvek/manage/20"><i class="fa fa-pencil"></i> <span>Nyelvek</span></a></li>
             <li><a href="<?=base_url()?>tipusok/manage/20"><i class="fa fa-pencil"></i> <span>Típusok</span></a></li>
             <li><a href="<?=base_url()?>gyujtemenyek/manage/20"><i class="fa fa-pencil"></i> <span>Gyűjtemények</span></a></li>
          </ul>
        </li>



        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-key"></i> <span>ADMIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="<?=base_url()?>backup/manage/20"><i class="fa fa-undo"></i> <span>Backup</span></a></li>
             <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-file-o"></i> <span>Összegzés</span></a></li>
             <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-file-o"></i> <span>Személyzet</span></a></li>             
          </ul>
        </li-->

        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>JELENTÉSEK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>https://adminlte.io/docs" class="disabled"><i class="fa fa-file-o"></i> <span>Jelentési lista</span></a></li>
          </ul>
        </li-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i> <span>OLDALAK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url()?>backup/manage/20"><i class="fa fa-undo"></i> <span>Backup</span></a></li>
            <li><a href="<?=base_url()?>hirek/manage"><i class="fa fa-newspaper-o"></i> <span>Hírek</span></a></li>
            <li><a href="<?=base_url()?>hirlevelek/korlevel"><i class="fa fa-share-square"></i> <span>Hírlevél</span></a></li>
            <li><a href="<?=base_url()?>weboldalak/manage/20"><i class="fa fa-wrench"></i> <span>Oldalkezelés (cms)</span></a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      
      <?php
        $this->load->view($view_module.'/'.$view_file);
      ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--div class="pull-right hidden-xs">
      <b>Version</b> 2.0&nbsp;
    </div-->
    <strong>Copyright &copy; 2018 Created By Major Attila</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="<?=base_url()?>#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="<?=base_url()?>#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="<?=base_url()?>javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="<?=base_url()?>javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php if(!isset($sort_this)){?>
<!-- jQuery 3 - EZEK A SZAROK ZAVARJÁK A DRAG AND DROP-ot !!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
<!--script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script-->
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<?php } ?>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<?php /*
<!--AJAX DATATABLE-->    
<script src="http://localhost/projects/WORKING%20AJAX%20DATATABLE/media/js/jquery.dataTables.min.js"></script>
    <script src="http://localhost/projects/WORKING%20AJAX%20DATATABLE/media/js/dataTables.bootstrap.min.js"></script>  
*/ ?>

<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!--script src="<?=base_url()?>bower_components/raphael/raphael.min.js"></script-->
<!--script src="<?=base_url()?>bower_components/morris.js/morris.min.js"></script-->
<!-- ChartJS -->
<script src="<?=base_url()?>bower_components/Chart.js/Chart.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="<?=base_url()?>dist/js/pages/dashboard.js"></script-->
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>

<script>
  $(document).ready(function(){
    $('.pagination a').click(function(){
      var url = $(this).attr('href');
      var keres = $("input[name='keres']").val();
      var rendez = $("#rendez option:selected").val();
      var add_keres = 'keres='+keres;
      var add_rendez = 'rendez='+rendez;
      var add_variables = "";

      /*
      if(add_keres!='keres=' && add_rendez!='rendez='){
        add_variables += '?'+add_keres+'&'+add_rendez;
      }else if(add_keres!='keres='){
        add_variables += '?'+add_keres;
      }else if(add_rendez!='rendez='){
        add_variables += '?'+add_rendez;
      }
      */

      if(<?= (isset($_GET['keres'])||isset($_GET['rendez']))?"true":"false" ?>){
        add_variables += '?'+add_keres+'&'+add_rendez
      }

      $(this).attr('href',url+add_variables);
    });
  });
</script>

</body>
</html>
