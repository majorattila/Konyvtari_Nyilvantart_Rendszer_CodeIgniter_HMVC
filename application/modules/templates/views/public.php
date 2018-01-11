<?php
$first_segment = $this->uri->segment(1);
$second_segment = $this->uri->segment(2);
?>

<!DOCTYPE html>
<html>
<head>

<title>Bibliotéka</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="icon" href="<?= base_url() ?>dist/img/llama_ico.png">

<link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!--script src="<?=base_url()?>bower_components/bootstrap/dist/js/popper.js"></script-->
<!--script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script-->

<!-- DataTables -->
<link rel="stylesheet" href="<?=base_url()?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<!--link href="https://fonts.googleapis.com/css?family=Expletus+Sans" rel="stylesheet"-->
<!--link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet"-->

<style>
/*
  @font-face {
  font-family: "PT Serif Caption";
  font-style: normal;
  font-weight: 400;
  src: local("Cambria"), local("PT Serif Caption"), local("PTSerif-Caption"), url(https://themes.googleusercontent.com/static/fonts/ptserifcaption/v6/7xkFOeTxxO1GMC1suOUYWWhBabBbEjGd1iRmpyoZukE.woff) format('woff');
}
@font-face {
  font-family: "Open Sans Bold";
  font-style: normal;
  font-weight: 700;
  src: local("Segoe UI Bold"), local("Open Sans Bold"), local("OpenSans-Bold"), url(https://themes.googleusercontent.com/static/fonts/opensans/v8/k3k702ZOKiLJc3WVjuplzJ1r3JsPcQLi8jytr04NNhU.woff) format('woff');
}
*/
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 400;
  src: local("Segoe UI"), local("Open Sans"), local("OpenSans"), url(https://themes.googleusercontent.com/static/fonts/opensans/v8/K88pR3goAWT7BTt32Z01mz8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
  font-family: "Open Sans Light";
  font-style: normal;
  font-weight: 300;
  src: local("Segoe UI Light"), local("Open Sans Light"), local("OpenSans-Light"), url(https://themes.googleusercontent.com/static/fonts/opensans/v8/DXI1ORHCpsQm3Vp6mXoaTZ1r3JsPcQLi8jytr04NNhU.woff) format('woff');
}
nav{
  border: 0px !important;
  border-radius: 0px !important;
  background-color: #1ba1e2 !important; /*#8BC34A*/
}
nav a{
    color: #fff !important;
    font-family: 'Open Sans Light';
}
nav .dropdown-menu>li>a{  
  line-height: 35px;
}
.navbar-nav>li>a {
  line-height: 30px !important;
}
.navbar-brand {
  line-height: 30px !important;
  height: auto !important;
}
nav a:hover{
  background-color:#00AAFD !important;
}
nav button{
  background-color:#fff !important;
}
.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
    color: #555;
    background-color: #00AAFD !important;
}
footer{
  /*
  position: absolute;
  top: 96%;
  */
  margin-top:100px;
  text-align: center;
}
.pink{
    background-color: #ff0081 !important;
    font-weight: bold;
    font-size: 16pt;
    color: #fff !important;
}
.clickable-row{
  cursor:pointer;
}
.navbar li {
    margin: 0 0 0 0 !important;
}



.btn-link:focus, a:focus,
.btn-link:active:focus, a:active:focus{
    outline:none;
}

.btn-link:focus, a:focus{
    text-decoration:none;
}
.btn-link:hover, a:hover{
    text-decoration:underline;
}
</style>

</head>
<body>

<?php
  echo Modules::run('navbar/draw_navbar_to_top');
?>

<div class="container" style="min-height: 750px;">

<?php

  /*
  if($customer_id > 0){
    include('customer_panel_top.php');
  }
  */


  if(isset($oldal_tartalom)){
    echo nl2br($oldal_tartalom);

    if(!isset($oldal_url)) {
      $oldal_url = 'homepage';
    }

    if($oldal_url==""){
      require_once('kezdolap_tartalma.php');
    }else{
      //load up contact form
      echo Modules::run('contactus/_draw_form');
    }
  }elseif(isset($view_file)){
    $this->load->view($view_module.'/'.$view_file);
  }
?>

</div>
<footer>
  <p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2018 Created By Major Attila</p>
</footer>

<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $('.clickable-row').click(function(){
    var new_oldal_url = $(this).data('url');
    window.location = new_oldal_url;
  });
</script>

</body>
</html>