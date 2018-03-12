<?php
$first_segment = $this->uri->segment(1);
$second_segment = $this->uri->segment(2);
?>

<!DOCTYPE html>
<html>
<head>

<title>KossuthKönyvtár<?=isset($oldal_cim)?' | '.$oldal_cim:''?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Tell the browser to be responsive to screen width -->
<meta name="description" content="<?=isset($oldal_leiras)?$oldal_leiras:''?>">
<meta name="keywords" content="<?=isset($oldal_kulcsszavak)?$oldal_kulcsszavak:''?>">
<meta name="author" content="John Doe">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
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

<link rel="stylesheet" href="<?=base_url()?>dist/css/public.css">
<style>
  @font-face {
  font-family: Montserrat-Medium;
  font-style: normal;
  font-weight: 700;
  src: url("<?=base_url()?>dist/fonts/otf/Montserrat-Medium.otf") format("otf"), url("<?=base_url()?>dist/fonts/ttf/Montserrat-Medium.ttf") format("ttf"), url("<?=base_url()?>dist/fonts/webfonts/Montserrat-Medium.woff") format("woff"), url("<?=base_url()?>dist/fonts/webfonts/Montserrat-Medium.woff2") format("otf"), url() format('otf');
}
@font-face {
  font-family: Montserrat-Regular;
  font-style: normal;
  font-weight: 700;
  src: url("<?=base_url()?>dist/fonts/otf/Montserrat-Regular.otf") format("otf"), url("<?=base_url()?>dist/fonts/ttf/Montserrat-Regular.ttf") format("ttf"), url("<?=base_url()?>dist/fonts/webfonts/Montserrat-Regular.woff") format("woff"), url("<?=base_url()?>dist/fonts/webfonts/Montserrat-Regular.woff2") format("otf"), url() format('otf');
}
@media (min-width: 800px){
  body{    
    height: 100%;
    /*background: linear-gradient(to bottom right, #7f7f7f 0%, #2b2b2b 100%);*/
    background-image: url('<?=base_url()?>dist/img/background/main_background.jpg');  
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
  }  
}
</style>
</head>
<body>

<?php
  echo Modules::run('navbar/draw_navbar_to_top');
?>

<!--div class="container" style="min-height: 750px;"-->
<div class="container" style="
    min-height: 750px; /*750px*/
    padding-top: 20px;
    padding-right: 20px;
    padding-left: 20px;
  ">
<?php

  /*
  if($customer_id > 0){
    include('customer_panel_top.php');
  }
  */


  if(isset($oldal_tartalom)){
    echo $oldal_tartalom; //nl2br

    if(!isset($oldal_url)) {
      $oldal_url = 'homepage';
    }

    if($oldal_url==""){
      require_once('kezdolap_tartalma.php');
    }else if($oldal_url=="rolunk"){      
      require_once('rolunk.php');
    }else{
      //load up contact form
      echo Modules::run('contactus/_draw_form');
    }
  }elseif(isset($view_file)){
    $this->load->view($view_module.'/'.$view_file);
  }
?>
</div>


<footer class="container">
  <p><span class="hidden-xs">&nbsp;&nbsp;&nbsp;Copyright © 2018 </span>Created By Major Attila</p>
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

  $(document).ready(function(){
    $(".container:has(#reg_panel)").css({
    'background-color' : '#FFFFFF',
    'background-image' : 'url(<?=base_url()?>dist/img/background/danger-pattern.png)',
    'background-repeat' : 'repeat-x',
    'background-attachment' : 'fixed',
    'background-position' : 'top left'
    });
  });

/*
(function ($) {
  "use strict";
  $('.column100').on('mouseover',function(){
    var table1 = $(this).parent().parent().parent();
    var table2 = $(this).parent().parent();
    var verTable = $(table1).data('vertable')+"";
    var column = $(this).data('column') + ""; 

    $(table2).find("."+column).addClass('hov-column-'+ verTable);
    $(table1).find(".row100.head ."+column).addClass('hov-column-head-'+ verTable);
  });

  $('.column100').on('mouseout',function(){
    var table1 = $(this).parent().parent().parent();
    var table2 = $(this).parent().parent();
    var verTable = $(table1).data('vertable')+"";
    var column = $(this).data('column') + ""; 

    $(table2).find("."+column).removeClass('hov-column-'+ verTable);
    $(table1).find(".row100.head ."+column).removeClass('hov-column-head-'+ verTable);
  });
    

})(jQuery);
*/
</script>

</body>
</html>