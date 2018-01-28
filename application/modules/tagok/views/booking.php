<?php 
$this->load->module('php_strap_cv');
$first_segment = $this->uri->segment(1);
?>

<h1><?=$headline ?></h1>
<?= validation_errors("<p style='color:red;'>", "</p>");?>

<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

<?php

	if(isset($flash))
	{
		echo $flash;
	}

?>

<?php if(is_numeric($update_id)) { ?>
<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-gear"></i> Műveletek</h3>
						<div class="box-tools pull-right">
				            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			          </div>
					</div>
		<div class="box-body">
			<a href="<?= base_url() ?>tagok/delete_book_rental/<?= $user_id ?>/<?= $update_id ?>"><button type="button" class="btn btn-danger margin">Kölcsönzés Törlése</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>

<div class="row-fluid sortable">
	<div class="box box-default">
		<div class="box-header with-border" data-original-title>
			<h3 class="box-title"><i class="fa fa-fw fa-pencil"></i> Adatok</h3>
			<div class="box-tools pull-right">
	            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	      </div>
		</div>
		<div class="box-body">

		<?php
		$form_location = base_url()."tagok/kolcsonzes_create/".$user_id.'/'.$update_id;
		?>
			<form class="form-horizontal" method="post" action="<?= $form_location ?>">
			  <fieldset class="col-sm-12">


					<div class="row">
						<div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3">
					    	<label for="leltari_szam">Leltári szám</label>
							<div class="input-group col-xs-12">
					          <input name="leltari_szam" list="leltari_szamok" id="leltari_szam" class="form-control" autocomplete="off" value="<?=$leltari_szam?>">
					          <datalist id="leltari_szamok">
					          </datalist>
					        </div>
					    </div>
				    </div>

					<!--div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="leltari_szam">Leltári szám</label> <input name="leltari_szam" value="<?=$leltari_szam ?>" type="text" class="form-control" id="leltari_szam" maxlength="13"> </div></div-->
					<div class="row"><div class="form-group col-xs-12 col-md-10 col-lg-4 col-xl-3"> <label for="datum">Dátum</label> <input name="datum" value="<?=$datum ?>" type="date" class="form-control" id="datum"> </div></div><br/>

				<div class="form-actions">
				  <button type="submit" class="btn btn-success margin" name="submit" value="Submit">Mentés</button>
				  <button type="submit" class="btn btn-secondary margin" name="submit" value="Cancel">Mégse</button>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div>

<?php
$this->php_strap_cv->datalist('leltari_szam', 'leltari_szam', base_url().$first_segment.'/datalist/bibliografiak/leltari_szam');
?>