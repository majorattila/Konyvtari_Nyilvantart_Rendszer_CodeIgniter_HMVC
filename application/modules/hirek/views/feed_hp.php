<style>
@media (min-width: 992px){
	.feed_hp>.col-md-6:nth-child(1) {
    	max-width: 250px;
	}
}
</style>

<?php
$this->load->helper('text');
$this->load->module('timedate');
foreach ($query->result() as $row) {
	$article_preview = word_limiter($row->oldal_tartalom, 25);
	$kep = $row->kep;
	$thumbnail_name = str_replace('.', '_thumb.', $kep);
	$thumbnail_path = base_url().'hirek_pics/'. $thumbnail_name;
	$publikalas_datuma = $this->timedate->get_nice_date($row->publikalas_datuma, 'mini');
	$article_url = base_url().'hirek/kategoriak/10/0/'.$row->k_url.'/'.urlencode($row->oldal_url);
?>
	<div class="feed_hp row" style="margin-bottom: 12px;">
		<?php if(!empty($kep)){ ?>
		<div class="col-md-6">
			<a href="<?= $article_url ?>">
				<img src="<?= $thumbnail_path ?>" class="img-responsive img-thumbnail">
			</a>
		</div>
		<?php } ?>
		<div <?php if(!empty($kep)){ ?> class="col-md-6" <?php }else{ ?> class="col-md-12"<?php } ?>>
			<h4><a href="<?= $article_url ?>"><?= $row->oldal_cim ?></a></h4>
			<p style="font-size: 0.9em;">
				<?= ucfirst($row->k_neve) ?> - 
				<span style="color: #999;"><?= $publikalas_datuma ?></span>
			</p>
			<p style="font-size: 0.9em;"><?= $row->nev ?></p>
			<?php if(empty($kep)){ ?><p><?= substr($row->oldal_leiras,0,200).'...' ?></p><?php } ?>
		</div>
	</div>
<?php
}
?>