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

<link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">

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
@media (max-width:576px){
	body div.container::after{
		margin-bottom: 60px;
	}
	nav{
		z-index:999;
		width:100%;
		position:fixed !important;
	}
}









@media (max-width:992px){
	#afscontainer1{
		display: none;
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


<!-- Composite Start -->
<div id="M308608ScriptRootC199269">
<div id="M308608PreloadC199269">
Loading...    </div>
<script>
        (function(){
    var D=new Date(),d=document,b='body',ce='createElement',ac='appendChild',st='style',ds='display',n='none',gi='getElementById';
    var i=d[ce]('iframe');i[st][ds]=n;d[gi]("M308608ScriptRootC199269")[ac](i);try{var iw=i.contentWindow.document;iw.open();iw.writeln("<ht"+"ml><bo"+"dy></bo"+"dy></ht"+"ml>");iw.close();var c=iw[b];}
    catch(e){var iw=d;var c=d[gi]("M308608ScriptRootC199269");}var dv=iw[ce]('div');dv.id="MG_ID";dv[st][ds]=n;dv.innerHTML=199269;c[ac](dv);
    var s=iw[ce]('script');s.async='async';s.defer='defer';s.charset='utf-8';s.src="//jsc.adskeeper.co.uk/f/i/filmek-online.com.199269.js?t="+D.getYear()+D.getMonth()+D.getDate()+D.getHours();c[ac](s);})();
</script>
</div>
<!-- Composite End -->


</div>


<footer class="container">

<div class="col-xs-12" style="width:100%;height: max-content;background-color:#ccc;"><br>
	<div class="col-sm-4 col-xs-12">
	    <h4>Gyorslinkek</h4>
	    <div class="text-center">
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>hirek/kategoriak">Hírek</a></div>
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>katalogus/kereses">Katalógus</a></div>
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>konyvtarak/kirendeltseg">Alkönyvtárak</a></div>
		</div>
	</div>

	<div class="col-sm-4 col-xs-12">
	    <h4>Rólunk</h4>
		<div class="text-center">
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>joginyilatkozat">Jogi nyilatkozat</a></div>
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>szabalyok_es_feltetelek">Szabályok és feltételek</a></div>
		    <div class="col-xs-4 col-sm-12"><a href="<?=base_url()?>adatvedelem">Adatvédelmi szabályzat</a></div>
		</div>
	</div>

	<div class="col-sm-4 col-xs-12">
	    <h4>Kapcsolat</h4><div class="text-center">
	    <div class="col-xs-12 col-sm-12"><span>Tel.: </span><a href="tel:06205534854156">+36 (20) 553 48-54</a></div>
	    <div class="col-xs-12 col-sm-12">Cím: Budapest 1083 Tömő u. 48-54 156</div>
	    <div class="col-xs-12 col-sm-12">Email: <a href="mailto:attilamajor1997@gmail.com">attilamajor1997@gmail.com</a></div>
	</div>

	</div>
</div>

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







<!--https://cookieconsent.insites.com/-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "content": {
    "message": "Weboldalunk a jobb felhasználói élmény biztosítása érdekében sütiket használ. A weboldal használatával Ön beleegyezik az ilyen adatfájlok fogadásába és elfogadja a süti-kezelésre vonatkozó irányelveket.",
    "dismiss": "Megértettem",
    "link": "Bővebben"
  }
})});
</script>








<!--https://developers.google.com/custom-search-ads/docs/code-generator-->
<script src="https://www.google.com/adsense/search/ads.js" type="text/javascript" nonce="5gxYe56Da/6O3uqnbE1j/g=="></script>

<script type="text/javascript" charset="utf-8">

  var pageOptions = {
    "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
    "query": "hawai",
    "adPage": 1
  };

  var adblock1 = {
    "container": "afscontainer1",
    "width": "100%",
    "number": 2
  };

  _googCsa('ads', pageOptions, adblock1);

</script>







<script type="text/javascript" charset="utf-8">

  var pageOptions = {
    "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
    "query": "usa",
    "adPage": 1
  };

  var adblock1 = {
    "container": "afscontainer2",
    "width": "100%",
    "number": 2
  };

  _googCsa('ads', pageOptions, adblock1);

</script>

</body>
</html>