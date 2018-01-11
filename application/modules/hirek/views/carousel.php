<style>
	.link{
		/*font-family:Lobster;*/
		font-size:22pt !important;
		color: #FFFFFF;
	}
	.link:hover{
		text-decoration: none;
		box-shadow: inset 0 -2px 0 white, inset 0 -3px 0 black;
		color: #FFFFFF;
	}
	.link:focus{
		color: #FFFFFF;
	}

	.carousel-caption{
		padding: 0px;
	    height: 150px;
	    width: 100%;
	    left: 0px;
	    background-color: rgba(25, 25, 25, 0.72);
	}
	.carousel-control.left{
	background-image: none;
	}	
	.carousel-control.right{	
	background-image: none;
	}
	.carousel {
    box-shadow: 0px 0px 5px black;
    /*border-radius: 8px;*/
	}
	/*
	img{
		border-radius:8px !important;
	}
	*/

	.carousel-inner{
		/*animation: colorchange 50s; /* animation-name followed by duration in seconds*/
         /* you could also use milliseconds (ms) or something like 2.5s */
      /*-webkit-animation: colorchange 50s;*/ /* Chrome and Safari */
      /*animation-iteration-count: infinite;*/
      background-color: #000;
	}
	/*
	@keyframes colorchange
    {
      0%   {background: red;}
      25%  {background: yellow;}
      50%  {background: blue;}
      75%  {background: green;}
      100% {background: red;}
    }

    @-webkit-keyframes colorchange /* Safari and Chrome - necessary duplicate *//*
    {
      0%   {background: red;}
      25%  {background: yellow;}
      50%  {background: blue;}
      75%  {background: green;}
      100% {background: red;}
    }
    */
    /*
    .carousel-indicators li{
		background-color: rgb(255, 255, 255) !important;
	    border: 1px solid #c7c7c7 !important;
	    border-radius: 0px !important;
	    width: 33px !important;
	    height: 4px !important;
    }
    .carousel-indicators li.active{
	    background-color: #b100ff !important;
	    border: 1px solid #b100ff !important;
	    border-radius: 0px !important;
	    width: 33px !important;
	    height: 4px !important;
    }
    */
</style>
<?php
$this->load->module('timedate');
?>

 <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 434px;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li style="margin: 5px;" data-target="#myCarousel" data-slide-to="0" class="active"></li>
    	<?php for ($i=1; $i < $query->num_rows(); $i++) { 
      		echo '<li style="margin: 5px;" data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
    	} ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" style="height: 100%; width: 100%;">

<?php
$i = 0;
foreach ($query->result() as $row) {
	$article_preview = word_limiter($row->oldal_tartalom, 25);
	$kep = $row->kep;
	$thumbnail_path = base_url().'hirek_pics/'. $kep;
	$publikalas_datuma = $this->timedate->get_nice_date($row->publikalas_datuma, 'mini');
	$article_url = base_url().'hirek/kategoriak/'.$row->k_url.'/'.urlencode($row->oldal_url);
	$i++;
	/*
?>
	<div class="row" style="margin-bottom: 12px;">
		<div class="col-md-3">
			<img src="<?= $thumbnail_path ?>" class="img-responsive img-thumbnail">
		</div>
		<div class="col-md-9">
			<h4><a href="<?= $article_url ?>"><?= $row->oldal_cim ?></a></h4>
			<p style="font-size: 0.9em;">
				<?= $row->szerzo ?> - 
				<span style="color: #999;"><?= $publikalas_datuma ?></span>
			</p>
			<p><?= $row->oldal_tartalom ?></p>
		</div>
	</div>
	<?php */ ?>

 
	<?php if($i == 1){ ?>
      <div class="item active">
    <?php }else{ ?>
      <div class="item">
    <?php } ?>
    <?php if(!empty($kep)){ ?>
        <img src="<?= $thumbnail_path ?>" alt="<?= $row->oldal_cim ?> ilusztráció" style="height: -webkit-fill-available; width: 100%;">
    <?php }else{ ?>
    	<!--img src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=" alt="<?= $row->oldal_cim ?> ilusztráció" style="height: -webkit-fill-available; margin: 0 auto;"-->
    	<video style="height: -webkit-fill-available; margin: 0 auto;" poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" playsinline autoplay muted loop><source src="<?= base_url() ?>dist/vid/Silky_Blue_720P_Motion_Background_Loop.mp4" type="video/mp4"></video>
    <?php } ?>
        <div class="carousel-caption">
			<a class="link" href="<?= $article_url ?>"><?= mb_substr($row->oldal_cim,0,37,"utf-8").(strlen($row->oldal_cim)>37? '...': '') ?></a>
			<h4 style="width: 500px; margin: 0 auto;"><?= $publikalas_datuma ?> - <?= mb_substr(str_replace(array('<p>','</p>','<h1>','</h1>','<h2>','<h3>','</h3>','<h4>','</h4>','<h5>','</h5>','<h6>','</h6>'),'',$row->oldal_leiras),0,100,"utf-8").'...' ?></h4>
		</div>
 	</div>

<?php
}
?>
<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
  <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  <span class="sr-only">Next</span>
</a>
</div>

</div>