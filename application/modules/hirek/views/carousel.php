<style>

	@media (min-width:295px) and (max-width:576px){	
		#myCarousel{
			height: 230px !important;
		}
	}

	@media (max-width:295px){			
		#myCarousel{
			height: 200px !important;
		}
	}

	@media (max-width:576px){
		.carousel-caption {
		    padding: 0px 20px 0px 20px;
		    height: 54px !important;
		}
		.carousel-caption h4{
			display: none;
		}
		.link {
		    font-size: 12pt !important;
		}
		.carousel-control.left {
		    background-image: none;
		    background-color: #ff7f00;
		    border-right: 1px solid white;
		    width: 24px;
		    opacity: unset;
		}
		.carousel-control.right {
		    background-image: none;
		    background-color: #ff7f00;
		    border-left: 1px solid white;
		    width: 24px;
		    opacity: unset;
		}	
	}

	.link{
		font-size:22pt;
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
	    line-height: initial;
	}
	.carousel-control.left{
	background-image: none;
	}	
	.carousel-control.right{	
	background-image: none;
	}
	.carousel {
    box-shadow: 0px 0px 5px black;
	}

	.carousel-inner{
      background-color: #000;
	}
</style>
<?php
$this->load->module('timedate');
if($query->num_rows() > 0){?>

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
	$article_url = base_url().'hirek/kategoriak/10/0/'.$row->k_url.'/'.urlencode($row->oldal_url);
	$i++;
?>

 
	<?php if($i == 1){ ?>
      <div class="item active">
    <?php }else{ ?>
      <div class="item">
    <?php } ?>
    <?php if(!empty($kep)){ ?>
        <img src="<?= $thumbnail_path ?>" alt="<?= $row->oldal_cim ?> ilusztráció" style="height: -webkit-fill-available; width: 100%;">
    <?php }else{ ?>
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

<?php } ?>